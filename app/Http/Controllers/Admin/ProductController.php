<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotifyUser;
use DateTime;
use Exception;
use App\Models\Product;
use App\Models\BidProduct;
use Illuminate\Http\Request;
use App\Enums\ProductStatusEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        $products = Product::where('product_title', 'Like', '%'.$request->input('search'). '%');
        if ($request->input('types')){
            $products = $products->where('product_status', $request->input('types'));
        }
        if ($request->input('category')){
            $products = $products->where('product_category', $request->input('category'));
        }
        $products = $products->with(['images', 'seller', 'buyer', 'bits' => function($query) {
            $query->orderByDesc('id')->first();
        }])->simplePaginate(12);
        return view('admin.products', ['products' => $products]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showCreateForm(){
        return view('create-product');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'product_title' => ['required'],
            'product_description' => ['required', 'max:255'],
            'product_base_price' => ['required', 'numeric'],
            'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        try {
            $file = $validatedData['product_image'];
            $validatedData['product_author'] = Auth::id();
            $validatedData['product_status'] = ProductStatusEnum::Deactivated()->value;

            if (!$request->hasFile('product_image')) return back()->withErrors([ 'product_image' => 'Image not Found.' ]);

            $path = explode('/', upload($file))[2];
            $product = Product::create($validatedData);
            $image = $product->images()->create([
                'image_url' => 'products/'.$path,
                'imageable_id' => $product->id,
                'imageable_type' => get_class($product)
            ]);
            return back()->with([
                'success' => "Product is Created!"
            ]);
        }catch (Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @return Application|Factory|View
     */
    public function showUpdateForm(int $id){
         $product = Product::find($id)->load('images');;
        return view('update-product', compact('product'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateStatus(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'status' => ['required'],
        ]);
        try {
            $product = Product::find($id);

            if ($product->product_status == 'Sold'){
                return back()->withErrors([
                    'error' => 'Failed to updated.'
                ]);
            }

            $bits = BidProduct::where('bid_product_id', $product->id)->orderBy('created_at', 'desc')->first();

            $is_updated = $product->update([
                'product_status' => $validatedData ['status']
            ]);
            if ($bits && $is_updated){
                NotifyUser::dispatch($bits->bid_product_buyer_id, $bits->bid_price );
            }
            $product->refresh();
            return back()->with([
                'success' => "Product is Updated!"
            ]);
        }catch (Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function showProduct($id) {
        $product = Product::find($id)->load('images', 'seller', 'buyer');
        $biting_price = BidProduct::where('bid_product_id', $id)->OrderBy('id', 'desc')->first();
        if ($biting_price) $biting_price = $biting_price['bid_price'];
        return view('product', ['product' => $product, 'biting_price' => $biting_price, 'interval' => interval("now", $product->created_at)]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function bit(Request $request): RedirectResponse
    {
        $product = Product::find($request->input('id'))->load('seller');
        if ($product->seller->id === Auth::id()){
            return back()->withErrors([ "error" => "You Cannot Bit Your Own Product!" ]);
        }
        $bid_product = [
            'bid_product_id' => $request->input('id'),
            'bid_product_buyer_id' => Auth::id(),
            'bid_price' => $request->input('bit_price')
        ];
        $product = BidProduct::create($bid_product);
        return back()->with([
            'success' => 'You Bit is Successful.'
        ]);
    }

    public function showUserProduct(Request $request) {
        $products = Product::with('images', 'seller', 'buyer');
        $products = $products->where('product_title', 'Like', '%'.$request->input('search'). '%');
        if ($request->input('category')){
            $products = $products->where('product_status', $request->input('category'));
        }
        if ($request->input('user_product_status') === 'self'){
            $products = $products->where('product_author', Auth::id());
        }
        if ($request->input('user_product_status') === 'purchased'){
            $products = $products->where('product_buyer', Auth::id());
        }
        $products = $products->paginate(12);
        return view('user-product', compact( 'products' ));
    }
}
