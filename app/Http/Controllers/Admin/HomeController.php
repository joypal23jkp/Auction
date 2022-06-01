<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductStatusEnum;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $latest_products =
            Product::where('product_status', ProductStatusEnum::Available()->value)
            ->with('images')
            ->paginate(12);

        return view('admin.home', ['products' => $latest_products]);
    }
}
