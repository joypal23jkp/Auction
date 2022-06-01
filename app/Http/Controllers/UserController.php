<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function showUserNotification()
    {
        $user_notification = DB::table('notifications')
            ->select('notifications.*', 'products.product_title as p_name')
            ->leftJoin('products', 'products.id', 'notifications.product_id')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('checked', false)
            ->orderByDesc('id')
           ->get();

        return view('notifications', ['notifications' => $user_notification]);
    }

    public function check($id)
    {
        if ($id)
        {
            $notif = DB::table('notifications')->where('id', $id);
            $notif->update([
                'checked' => true
            ]);
            return back()->with([
                'success' => 'Notification is Checked'
            ]);
        }
        return back()->withErrors([
            'error' => 'Failed'
        ]);
    }
}
