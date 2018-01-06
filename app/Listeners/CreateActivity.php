<?php

namespace App\Listeners;

use App\Events\SystemActivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\SystemActivity as SA;

class CreateActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SystemActivity  $event
     * @return void
     */
    public function handle(SystemActivity $event)
    {
        SA::create([
            'user'      => auth()->id(),
            'event'     => $event->text
            ]);
    }
}
