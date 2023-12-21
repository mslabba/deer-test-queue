<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $connection;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order, $connection = null)
    {
        $this->order = $order;
        $this->connection = $connection;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->order->user_email)->send(new OrderConfirmationMail($this->order));
        $this->order->update(['status' => 'Processing']);
    }

    public function queue($queue, $command)
    {
        return $this->connection ? $queue->connection($this->connection) : $queue;
    }
}
