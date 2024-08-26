<?php

namespace App\Listeners;

use App\Events\StoreProduct;
use App\Mail\ProductNotifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendProductEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(StoreProduct $event): void
    {
        $product = $event->product;

        $title = $product->title;
        $price = $product->price;

        Mail::to(env('MAIL_SEND_TO_EMAIL'))->send(new ProductNotifyEmail($title, $price));
    }
}
