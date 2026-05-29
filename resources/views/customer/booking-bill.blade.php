<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bill đơn hàng</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 30px;
            color: #111827;
        }

        .bill {
            max-width: 720px;
            margin: auto;
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .header {
            text-align: center;
            border-bottom: 2px dashed #ddd;
            padding-bottom: 20px;
            margin-bottom: 24px;
        }

        .header h1 {
            color: #c91f1f;
            margin: 0;
        }

        .tracking {
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            color: #6b7280;
        }

        .value {
            font-weight: 600;
            text-align: right;
        }

        .amount {
            color: #16a34a;
            font-size: 22px;
            font-weight: bold;
        }

        .actions {
            text-align: center;
            margin-top: 24px;
        }

        .btn {
            background: #16a34a;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-back {
            background: #6b7280;
            text-decoration: none;
            margin-right: 10px;
            display: inline-block;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .bill {
                box-shadow: none;
                border-radius: 0;
                max-width: 100%;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="bill">
    <div class="header">
        <h1>CourierXpress</h1>
        <p>PHIẾU GỬI HÀNG / BILL THANH TOÁN</p>
        <div class="tracking">
            {{ $courier->tracking_code ?? $courier->code ?? ('CX-' . $courier->id) }}
        </div>
    </div>

    <div class="row">
        <span class="label">Người gửi</span>
        <span class="value">{{ $courier->sender_name ?? '---' }}</span>
    </div>

    <div class="row">
        <span class="label">SĐT người gửi</span>
        <span class="value">{{ $courier->sender_phone }}</span>
    </div>

    <div class="row">
        <span class="label">Người nhận</span>
        <span class="value">{{ $courier->receiver_name ?? '---' }}</span>
    </div>

    <div class="row">
        <span class="label">SĐT người nhận</span>
        <span class="value">{{ $courier->receiver_phone }}</span>
    </div>

    <div class="row">
        <span class="label">Địa chỉ nhận</span>
        <span class="value">{{ $courier->receiver_address ?? $courier->destination_address ?? '---' }}</span>
    </div>

    <div class="row">
        <span class="label">Loại hàng</span>
        <span class="value">{{ $courier->item_type ?? $courier->package_type ?? '---' }}</span>
    </div>

    <div class="row">
        <span class="label">Khối lượng</span>
        <span class="value">{{ $courier->total_weight }} kg</span>
    </div>

    <div class="row">
        <span class="label">Phương thức thanh toán</span>
        <span class="value">COD - Thanh toán khi nhận hàng</span>
    </div>

    <div class="row">
        <span class="label">Số tiền COD</span>
        <span class="value amount">
            {{ number_format($courier->cod_amount ?? $courier->price ?? 0, 0, ',', '.') }} VNĐ
        </span>
    </div>

    <div class="row">
        <span class="label">Ngày tạo</span>
        <span class="value">{{ $courier->created_at ? $courier->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}</span>
    </div>

    <div class="actions">
        <a href="{{ route('customer.orders.index') }}" class="btn btn-back">Về đơn hàng</a>
        <button onclick="window.print()" class="btn">In bill</button>
    </div>
</div>

</body>
</html>
