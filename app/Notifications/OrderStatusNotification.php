<?php

namespace App\Notifications;

use App\Models\Courier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    // Map trạng thái → thông điệp hiển thị
    private array $messages = [
        'pending'    => ['title' => 'Đơn hàng đang chờ xử lý',    'body' => 'Đơn hàng {tracking_id} đã được tiếp nhận và đang chờ nhân viên xử lý.'],
        'processing' => ['title' => 'Đơn hàng đang được xử lý',   'body' => 'Đơn hàng {tracking_id} đang được đóng gói và chuẩn bị giao.'],
        'shipping'   => ['title' => 'Đơn hàng đang trên đường giao','body'=> 'Đơn hàng {tracking_id} đang được vận chuyển đến địa chỉ nhận.'],
        'delivered'  => ['title' => '🎉 Giao hàng thành công!',    'body' => 'Đơn hàng {tracking_id} đã được giao thành công. Cảm ơn bạn đã sử dụng CourierXpress!'],
        'cancelled'  => ['title' => 'Đơn hàng đã bị hủy',         'body' => 'Đơn hàng {tracking_id} đã bị hủy. Vui lòng liên hệ hỗ trợ nếu có thắc mắc.'],
    ];

    public function __construct(public Courier $order, public string $status) {}

    // Kênh gửi: database (lưu trong bảng notifications) + mail
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    // Dữ liệu lưu vào bảng notifications (JSON)
    public function toDatabase(object $notifiable): array
    {
        $msg = $this->getMessages();
        return [
            'tracking_id'  => $this->order->tracking_id,
            'status'       => $this->status,
            'title'        => $msg['title'],
            'body'         => $msg['body'],
            'order_url'    => url('/tracking?tracking_id=' . $this->order->tracking_id),
        ];
    }

    // Email gửi khi trạng thái thay đổi
    public function toMail(object $notifiable): MailMessage
    {
        $msg = $this->getMessages();
        return (new MailMessage)
            ->subject('[CourierXpress] ' . $msg['title'])
            ->greeting('Xin chào, ' . $notifiable->full_name . '!')
            ->line($msg['body'])
            ->action('Xem chi tiết đơn hàng', url('/tracking?tracking_id=' . $this->order->tracking_id))
            ->line('Cảm ơn bạn đã sử dụng dịch vụ CourierXpress.');
    }

    private function getMessages(): array
    {
        $tpl = $this->messages[$this->status] ?? [
            'title' => 'Cập nhật đơn hàng',
            'body'  => 'Đơn hàng {tracking_id} vừa được cập nhật trạng thái.',
        ];
        return [
            'title' => $tpl['title'],
            'body'  => str_replace('{tracking_id}', $this->order->tracking_id, $tpl['body']),
        ];
    }
}
