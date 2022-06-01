<?php

namespace App\Http\Controllers;

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
    public function index(): Renderable
    {
        $latest_products =
            Product::where('product_status', ProductStatusEnum::Available()->value)
            ->with('images')
            ->paginate(12);

        return view('home', ['products' => $latest_products]);
    }
}
