<?php

namespace App\Http\Controllers;

use App\Models\User;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        $products = Product::where('product_title', 'Like', '%'.$request->input('search'). '%');
        if ($request->input('type')){
            $products = $products->where('product_status', $request->input('type'));
        }
        if ($request->input('category')){
            $products = $products->where('product_category', $request->input('category'));
        }
        $products = $products->with('images', 'seller', 'buyer')->simplePaginate(5);
//        return $products;
//        return $products;
        return view('products', compact( 'products' ));
    }

    /**
     * @return Application|Factory|View
     */
    public function showCreateForm(){
        $categories = DB::table('categories')->get();
        return view('create-product', ['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
//        dd($request->all());
        $validatedData = $request->validate([
            'product_title' => ['required'],
            'product_description' => ['required', 'max:255'],
            'product_base_price' => ['required', 'numeric'],
            'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            "product_category" => ['required']
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
         $product = Product::find($id)->load('images');
        $categories = DB::table('categories')->get();
        return view('update-product', compact('product', 'categories'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function Update(Request $request, int $id): RedirectResponse
    {

        $validatedData = $request->validate([
            'product_title' => ['max:100'],
            'product_description' => ['max:255'],
            'product_base_price' => ['numeric'],
            'product_category' => ['max:20'],
            'product_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        try {
            $product = Product::find($id);
            if(interval($product->created_at, date('Y-m-d H:i:s'))->i > 5)
            {

                return back()->withErrors([
                    'error' => "Update Time Expired!"
                ]);
            }
            if ($request->hasFile('product_image')) {
                $file = $validatedData['product_image'];
                $delete_file = Storage::delete('public/'.$product->images[0]['image_url']);

                if ($delete_file){
                    $path = 'products/'.explode('/', upload($file))[2];
                    $image = $product->images()->update([
                        'image_url' => $path,
                    ]);
                }
            }

            $product->update($validatedData);
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
        $product = Product::find($id)->load('images', 'seller', 'buyer', 'comments');
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

    public function showUserProduct(Request $request){
        if (!Auth::check()){
            return back()->withErrors([
                'error' => 'Products Not Found'
            ]);
        }
        $products = Product::with('images', 'seller', 'buyer');
        $products = $products->where('product_title', 'Like', '%'.$request->input('search'). '%');
        if ($request->input('type')){
            $products = $products->where('product_status', $request->input('type'));
        }
         if ($request->input('category')){
            $products = $products->where('product_category', $request->input('category'));
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

    public function comment(Request $request, $id) {
        $validatedData = $request->validate([
            'details' => ['required'],
        ]);
        try {
            if (!Auth::check()){
                return back()->withErrors([
                    'error' => 'User Not Found'
                ]);
            }

            $product = Product::find($id);
            $payload = [
                'comment_text' => $validatedData['details'],
                'comment_by' => Auth::id(),
                'commentable_type' => get_class($product),
                'commentable_id' => $product->id,
            ];
            $comment = $product->comments()->create($payload);

            return back()->with([
                'success' => "Comment is successfully updated!"
            ]);
        }catch (Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }
    }

}
