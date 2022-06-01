<?php

namespace App\Listeners;

use App\Events\NotifyUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class NotifyUserListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param NotifyUser $event
     * @return void
     */
    public function handle(NotifyUser $event)
    {
       if ($event->status == 'purchase') {
          $status =  DB::table('notifications')->insert([
               'notify_for' => $event->status,
               'user_id' => $event->user_id,
               'details' => 'You Won a Product for '. $event->price . ' taka.',
              'created_at' => now()
           ]);
       }
    }
}
