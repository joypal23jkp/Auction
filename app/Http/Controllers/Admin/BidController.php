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
use Illuminate\Support\Facades\Storage;

class BidController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        return '';
    }
}
