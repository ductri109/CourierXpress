<?php

namespace App\Jobs;

use App\Mail\OrderDeliveredMail;
use App\Models\Courier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendOrderDeliveredEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 3;
    public int $backoff = 60;

    public function __construct(public Courier $order) {}

    public function handle(): void
    {
        // Chỉ gửi nếu đơn có customer và customer có email
        if (! $this->order->customer || ! $this->order->customer->email) {
            Log::info('[Queue][OrderDelivered] Bỏ qua: đơn không có customer hoặc email.', [
                'tracking_id' => $this->order->tracking_id,
            ]);
            return;
        }

        Mail::to($this->order->customer->email)
            ->send(new OrderDeliveredMail($this->order));

        Log::info('[Queue][OrderDelivered] Đã gửi email giao hàng thành công.', [
            'tracking_id' => $this->order->tracking_id,
            'to'          => $this->order->customer->email,
        ]);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('[Queue][OrderDelivered] Gửi email thất bại.', [
            'tracking_id' => $this->order->tracking_id,
            'error'       => $e->getMessage(),
        ]);
    }
}
