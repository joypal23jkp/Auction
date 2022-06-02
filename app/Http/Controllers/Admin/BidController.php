<?php

namespace App\Http\Controllers\Admin;

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

class BidController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        $bits = DB::table('bid_products')
            ->select('bid_products.*', 'products.product_title', 'products.product_base_price', 'users.name as user_name', 'users.email as user_email', 'users.type as user_type' )
            ->join('products', 'bid_products.bid_product_id', 'products.id')
            ->join('users', 'users.id', 'bid_products.bid_product_buyer_id')
            ->where('users.name', 'Like', '%'.$request->input('user_search'). '%')
            ->where('products.product_title', 'Like', '%'.$request->input('product_search'). '%')
//            ->join('categories', 'categories.id', 'products.product_category')
            ->orderByDesc('id')
            ->simplePaginate(10);
        return view('admin.bits', compact('bits'));
    }
}
