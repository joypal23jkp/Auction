<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        $users = User::where('name', 'Like', '%'.$request->input('search'). '%');
        if ($request->input('category')){
            $users = $users->where('status', $request->input('category'));
        }
        $users = $users->simplePaginate(1);
        $users = DB::table('users')
                ->select('users.*', 'users.id as u_id', DB::raw('count(products.product_author) as products_author_count'),
                    DB::raw('count(products.product_buyer) as products_buyer_count') )
                ->leftJoin('products', 'products.product_author', 'users.id',  )
                ->groupBy('u_id')
                ->where('name', 'Like', '%'.$request->input('search'). '%');
        if ($request->input('category')){
            $users = $users->where('status', $request->input('category'));
        }
        $users = $users->simplePaginate(10);
        return view('admin.users', ['users' => $users]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'status' => ['required'],
        ]);
        try {
            $user = User::find($id);

            $user->status = $validatedData ['status'];
            $user->save();
            $user->refresh();
            return back()->with([
                'success' => "User is Updated!"
            ]);
        }catch (Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }
    }


}
