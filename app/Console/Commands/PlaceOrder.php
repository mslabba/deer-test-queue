<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessOrder;
use App\Models\Order;

class PlaceOrder extends Command
{
    protected $signature = 'place-order {user_email} {order_amount}';
    protected $description = 'Simulate a user placing an order.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userEmail = $this->argument('user_email');
        $orderAmount = $this->argument('order_amount');

        $order = Order::create([
            'user_email' => $userEmail,
            'order_amount' => $orderAmount,
        ]);

        ProcessOrder::dispatch($order, 'database');

        $this->info("Order placed successfully. Order ID: $order->id");
    }
}
