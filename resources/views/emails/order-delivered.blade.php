<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order Delivered Successfully - CourierXpress</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f5f9;padding:32px 16px;">
    <tr><td align="center">

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;background-color:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e2e8f0;">

                <tr>
                    <td style="background:linear-gradient(135deg,#0d9488 0%,#059669 100%);padding:40px 40px 32px;text-align:center;">
                        <div style="width:64px;height:64px;background:rgba(255,255,255,0.2);border:2px solid rgba(255,255,255,0.35);border-radius:50%;margin:0 auto 16px;line-height:64px;font-size:30px;text-align:center;">
                            🎉
                        </div>
                        <div style="font-size:26px;font-weight:900;color:#ffffff;letter-spacing:-0.5px;margin-bottom:4px;">
                            Courier<span style="color:#99f6e4;">Xpress</span>
                        </div>
                        <div style="font-size:12px;color:rgba(255,255,255,0.7);margin-bottom:20px;letter-spacing:0.5px;">
                            Smart Logistics System 24/7
                        </div>
                        <div style="display:inline-block;background:rgba(0,0,0,0.15);border:1.5px solid rgba(255,255,255,0.2);border-radius:999px;padding:7px 20px;font-size:13px;font-weight:700;color:#ffffff;">
                            ✅ &nbsp;Delivered Successfully!
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="padding:36px 40px 0;">

                        <p style="margin:0 0 6px;font-size:19px;font-weight:800;color:#0f172a;">
                            Hello, {{ $order->customer->full_name ?? $order->sender_name }}!
                        </p>
                        <p style="margin:0 0 28px;font-size:13.5px;color:#64748b;line-height:1.7;">
                            Your parcel has been <strong style="color:#1e293b;">successfully delivered</strong> to the recipient.
                            Thank you for choosing and trusting <strong>CourierXpress</strong> services!
                        </p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:linear-gradient(135deg,#ecfdf5,#f0fdfa);border:2px solid #10b981;border-radius:12px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:24px;text-align:center;">
                                    <div style="font-size:36px;margin-bottom:8px;">📦</div>
                                    <div style="font-size:18px;font-weight:900;color:#065f46;margin-bottom:6px;">Delivered Successfully!</div>
                                    <div style="font-size:12.5px;color:#059669;margin-bottom:10px;">
                                        The package has reached the recipient &nbsp;·&nbsp; {{ now()->format('H:i — m/d/Y') }}
                                    </div>
                                    <div style="font-size:22px;font-weight:900;color:#10b981;letter-spacing:4px;">
                                        {{ $order->tracking_id }}
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 10px;font-size:10px;text-transform:uppercase;letter-spacing:1.5px;font-weight:700;color:#94a3b8;">
                            Shipping Route
                        </p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:20px 20px 10px;">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="vertical-align:top;padding-top:3px;padding-right:12px;">
                                                <div style="width:12px;height:12px;background:#94a3b8;border-radius:50%;border:3px solid #e2e8f0;"></div>
                                            </td>
                                            <td>
                                                <div style="font-size:13.5px;font-weight:700;color:#0f172a;">{{ $order->sender_name }} (Sender)</div>
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
                                                <div style="width:12px;height:12px;background:#10b981;border-radius:50%;border:3px solid #d1fae5;"></div>
                                            </td>
                                            <td>
                                                <div style="font-size:13.5px;font-weight:700;color:#0f172a;">
                                                    {{ $order->receiver_name }} (Receiver)
                                                    <span style="font-size:12px;color:#10b981;font-weight:700;margin-left:6px;">✓ Received</span>
                                                </div>
                                                <div style="font-size:12px;color:#64748b;margin-top:2px;">{{ $order->receiver_address }}</div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 10px;font-size:10px;text-transform:uppercase;letter-spacing:1.5px;font-weight:700;color:#94a3b8;">
                            Shipping Invoice
                        </p>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
                            <thead>
                            <tr>
                                <th style="background:#f1f5f9;text-align:left;padding:9px 12px;font-size:10px;text-transform:uppercase;letter-spacing:0.8px;color:#94a3b8;font-weight:700;border-radius:6px 0 0 0;">Information</th>
                                <th style="background:#f1f5f9;text-align:right;padding:9px 12px;font-size:10px;text-transform:uppercase;letter-spacing:0.8px;color:#94a3b8;font-weight:700;border-radius:0 6px 0 0;">Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Tracking ID</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#10b981;">{{ $order->tracking_id }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Delivery Time</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ $order->updated_at->format('H:i — m/d/Y') }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Sender</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ $order->sender_name }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Weight</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ $order->total_weight }} kg</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#475569;">Payment Method</td>
                                <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;font-size:13px;font-weight:700;color:#0f172a;">{{ strtoupper($order->payment_method) }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 12px;font-size:13px;color:#475569;">Status</td>
                                <td style="padding:10px 12px;text-align:right;font-size:13px;font-weight:700;color:#10b981;">✓ Delivered Successfully</td>
                            </tr>
                            </tbody>
                        </table>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border-radius:10px;margin-bottom:28px;">
                            <tr>
                                <td style="padding:16px 18px;">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="font-size:13px;color:#64748b;padding-bottom:6px;">Base Fee</td>
                                            <td style="font-size:13px;color:#64748b;text-align:right;padding-bottom:6px;">30.000 ₫</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:13px;color:#64748b;padding-bottom:10px;">Weight Surcharge ({{ $order->total_weight }} kg × 10.000 ₫)</td>
                                            <td style="font-size:13px;color:#64748b;text-align:right;padding-bottom:10px;">{{ number_format($order->total_weight * 10000, 0, ',', '.') }} ₫</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="border-top:1px solid #e2e8f0;padding-top:10px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:15px;font-weight:900;color:#10b981;padding-top:4px;">Total Paid</td>
                                            <td style="font-size:15px;font-weight:900;color:#10b981;text-align:right;padding-top:4px;">{{ number_format($order->shipping_fee ?: ($order->total_weight * 10000 + 30000), 0, ',', '.') }} ₫</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
                            <tr>
                                <td align="center">
                                    <a href="{{ config('app.url') }}/tracking?tracking_id={{ $order->tracking_id }}"
                                       style="display:inline-block;background-color:#10b981;color:#ffffff;font-size:14px;font-weight:800;text-decoration:none;padding:14px 36px;border-radius:999px;">
                                        🔍 &nbsp;View Order Details
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 36px;font-size:12.5px;color:#94a3b8;text-align:center;line-height:1.7;">
                            Thank you for choosing <strong>CourierXpress</strong>!<br>
                            Support: <a href="mailto:support@courierxpress.vn" style="color:#10b981;text-decoration:none;">support@courierxpress.vn</a>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="background:#f8fafc;border-top:1px solid #f1f5f9;padding:22px 40px;text-align:center;">
                        <p style="margin:0;font-size:12px;color:#94a3b8;line-height:1.7;">
                            © {{ date('Y') }} <strong style="color:#475569;">CourierXpress</strong>. All rights reserved.<br>
                            Hanoi, Vietnam &nbsp;·&nbsp;
                            <a href="{{ config('app.url') }}" style="color:#10b981;text-decoration:none;">courierxpress.vn</a>
                        </p>
                    </td>
                </tr>

            </table>
        </td></tr>
</table>
</body>
</html>
