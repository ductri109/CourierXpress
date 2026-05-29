<?php

namespace App\Jobs;

use App\Mail\OrderCreatedMail;
use App\Models\Courier;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendOrderCreatedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 3;
    public int $backoff = 60;

    public function __construct(
        public Courier   $order,
        public Customer  $customer
    ) {}

    public function handle(): void
    {
        Mail::to($this->customer->email)
            ->send(new OrderCreatedMail($this->order));

        Log::info('[Queue][OrderCreated] Đã gửi email xác nhận đơn hàng.', [
            'tracking_id' => $this->order->tracking_id,
            'to'          => $this->customer->email,
        ]);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('[Queue][OrderCreated] Gửi email thất bại.', [
            'tracking_id' => $this->order->tracking_id,
            'error'       => $e->getMessage(),
        ]);
    }
}
