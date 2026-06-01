<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đơn hàng đã tiếp nhận - CourierXpress</title>
    <!--[if mso]>
    <noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript>
    <![endif]-->
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">

<!-- Wrapper -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f5f9;padding:32px 16px;">
    <tr><td align="center">

            <!-- Card -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;background-color:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e2e8f0;">

                <!-- ── HEADER ── -->
                <tr>
                    <td style="background:linear-gradient(135deg,#dc2626 0%,#9f1239 100%);padding:40px 40px 32px;text-align:center;">
                        <!-- Icon -->
                        <div style="width:64px;height:64px;background:rgba(255,255,255,0.2);border:2px solid rgba(255,255,255,0.35);border-radius:50%;margin:0 auto 16px;line-height:64px;font-size:30px;text-align:center;">
                            📬
                        </div>
                        <!-- Brand -->
                        <div style="font-size:26px;font-weight:900;color:#ffffff;letter-spacing:-0.5px;margin-bottom:4px;">
                            Courier<span style="color:#fde68a;">Xpress</span>
                        </div>
                        <div style="font-size:12px;color:rgba(255,255,255,0.7);margin-bottom:20px;letter-spacing:0.5px;">
                            Hệ thống vận chuyển thông minh 24/7
                        </div>
                        <!-- Badge -->
                        <div style="display:inline-block;background:rgba(0,0,0,0.15);border:1.5px solid rgba(255,255,255,0.2);border-radius:999px;padding:7px 20px;font-size:13px;font-weight:700;color:#ffffff;">
                            ✅ &nbsp;Đơn hàng đã được tiếp nhận
                        </div>
                    </td>
                </tr>

                <!-- ── BODY ── -->
                <tr>
                    <td style="padding:36px 40px 0;">

                        <!-- Greeting -->
                        <p style="margin:0 0 6px;font-size:19px;font-weight:800;color:#0f172a;">
                            Xin chào, {{ $order->sender_name }}!
                        </p>
                        <p style="margin:0 0 28px;font-size:13.5px;color:#64748b;line-height:1.7;">
                            Đơn hàng của bạn đã được <strong style="color:#1e293b;">CourierXpress</strong> tiếp nhận thành công.
                            Vui lòng lưu lại mã vận đơn bên dưới để theo dõi hành trình gói hàng.
                        </p>

                        <!-- Tracking ID box -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:linear-gradient(135deg,#fff1f2,#fff5f5);border:2px dashed #fca5a5;border-radius:12px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:22px;text-align:center;">
                                    <div style="font-size:10px;text-transform:uppercase;letter-spacing:2px;font-weight:700;color:#ef4444;margin-bottom:6px;">
                                        Mã vận đơn
                                    </div>
                                    <div style="font-size:28px;font-weight:900;color:#b91c1c;letter-spacing:5px;">
                                        {{ $order->tracking_id }}
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <!-- Section label -->
                        <p style="margin:0 0 10px;font-size:10px;text-transform:uppercase;letter-spacing:1.5px;font-weight:700;color:#94a3b8;">
                            Tuyến vận chuyển
                        </p>

                        <!-- Route -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:20px 20px 10px;">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="vertical-align:top;padding-top:3px;padding-right:12px;">
                                                <div style="width:12px;height:12px;background:#dc2626;border-radius:50%;border:3px solid #fecaca;"></div>
                                            </td>
                                            <td>
                                                <div style="font-size:13.5px;font-weight:700;color:#0f172a;">{{ $order->sender_name }}</div>
                                                <div style="font-size:12px;color:#64748b;margin-top:2px;">{{ $order->sender_address }}</div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0 20px;">
                                    <div style="width:2px;height:20px;background:#e2e8f0;margin-left:5px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0 20px 20px;">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="vertical-align:top;padding-top:3px;padding-right:12px;">
                                                <div style="width:12px;height:12px;background:#94a3b8;border-radius:50%;border:3px solid #e2e8f0;"></div>
                                            </td>
                                            <td>
                                                <div style="font-size:13.5px;font-weight:700;color:#0f172a;">{{ $order->receiver_name }}</div>
                                                <div style="font-size:12px;color:#64748b;margin-top:2px;">{{ $order->receiver_address }}</div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Section label -->
                        <p style="margin:0 0 10px;font-size:10px;text-transform:uppercase;letter-spacing:1.5px;font-weight:700;color:#94a3b8;">
                            Thông tin đơn hàng
                        </p>

                        <!-- Invoice table -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
                            <thead>
                            <tr>
                                <th style="background:#f1f5f9;text-align:left;padding:9px 12px;font-size:10px;text-transform:uppercase;letter-spacing:0.8px;color:#94a3b8;font-weight:700;">Thông tin</th>
                                <th style="background:#f1f5f9;text-align:right;padding:9px 12px;font-size:10px;text-transform:uppercase;letter-spacing:0.8px;color:#94a3b8;font-weight:700;">Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Mã vận đơn</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#dc2626;">{{ $order->tracking_id }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Ngày tạo đơn</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ $order->created_at->format('H:i — d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Người gửi</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ $order->sender_name }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Người nhận</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ $order->receiver_name }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Khối lượng hàng</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ $order->total_weight }} kg</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;font-size:13px;color:#475569;">Trạng thái</td>
                                <td style="padding:10px 12px;text-align:right;font-size:13px;font-weight:700;color:#f59e0b;">🕐 Đang chờ xử lý</td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- Fee box -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border-radius:10px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:16px 18px;">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="font-size:13px;color:#64748b;padding-bottom:6px;">Phí cơ bản</td>
                                            <td style="font-size:13px;color:#64748b;text-align:right;padding-bottom:6px;">30.000 ₫</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:13px;color:#64748b;padding-bottom:10px;">Phí khối lượng ({{ $order->total_weight }} kg × 10.000 ₫)</td>
                                            <td style="font-size:13px;color:#64748b;text-align:right;padding-bottom:10px;">{{ number_format($order->total_weight * 10000, 0, ',', '.') }} ₫</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="border-top:1px solid #e2e8f0;padding-top:10px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:15px;font-weight:900;color:#dc2626;padding-top:4px;">Tổng phí vận chuyển</td>
                                            <td style="font-size:15px;font-weight:900;color:#dc2626;text-align:right;padding-top:4px;">{{ number_format($order->shipping_fee ?: ($order->total_weight * 10000 + 30000), 0, ',', '.') }} ₫</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Notice box -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:14px 16px;">
                                    <p style="margin:0;font-size:12.5px;color:#92400e;line-height:1.6;">
                                        <strong>📋 Lưu ý:</strong> Đơn hàng của bạn đang trong hàng đợi và sẽ được nhân viên giao hàng tiếp nhận sớm nhất.
                                        Bạn sẽ nhận được thông báo khi trạng thái thay đổi.
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <!-- CTA -->
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td align="center">
                                    <a href="{{ config('app.url') }}/tracking?tracking_id={{ $order->tracking_id }}"
                                       style="display:inline-block;background-color:#eab308;color:#1c1917;font-size:14px;font-weight:800;text-decoration:none;padding:14px 36px;border-radius:999px;">
                                        🔍 &nbsp;Theo dõi đơn hàng ngay
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <!-- Footer note -->
                        <p style="margin:0 0 36px;font-size:12.5px;color:#94a3b8;text-align:center;line-height:1.7;">
                            Nếu bạn cần hỗ trợ, liên hệ tại
                            <a href="mailto:support@courierxpress.vn" style="color:#dc2626;text-decoration:none;">support@courierxpress.vn</a><br>
                            hoặc ghé trang <a href="{{ config('app.url') }}" style="color:#dc2626;text-decoration:none;">courierxpress.vn</a>
                        </p>
                    </td>
                </tr>

                <!-- ── FOOTER ── -->
                <tr>
                    <td style="background:#f8fafc;border-top:1px solid #f1f5f9;padding:22px 40px;text-align:center;">
                        <p style="margin:0;font-size:12px;color:#94a3b8;line-height:1.7;">
                            © {{ date('Y') }} <strong style="color:#475569;">CourierXpress</strong>. Tất cả quyền được bảo lưu.<br>
                            Hà Nội, Việt Nam &nbsp;·&nbsp;
                            <a href="{{ config('app.url') }}" style="color:#dc2626;text-decoration:none;">courierxpress.vn</a>
                        </p>
                    </td>
                </tr>

            </table>
            <!-- /Card -->

        </td></tr>
</table>
<!-- /Wrapper -->

</body>
</html>
