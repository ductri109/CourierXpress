<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Bill</title>

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
        <p>SHIPPING WAYBILL / PAYMENT BILL</p>
        <div class="tracking">
            {{ $courier->tracking_code ?? $courier->code ?? ('CX-' . $courier->id) }}
        </div>
    </div>

    <div class="row">
        <span class="label">Sender</span>
        <span class="value">{{ $courier->sender_name ?? '---' }}</span>
    </div>

    <div class="row">
        <span class="label">Sender Phone</span>
        <span class="value">{{ $courier->sender_phone }}</span>
    </div>

    <div class="row">
        <span class="label">Receiver</span>
        <span class="value">{{ $courier->receiver_name ?? '---' }}</span>
    </div>

    <div class="row">
        <span class="label">Receiver Phone</span>
        <span class="value">{{ $courier->receiver_phone }}</span>
    </div>

    <div class="row">
        <span class="label">Destination Address</span>
        <span class="value">{{ $courier->receiver_address ?? $courier->destination_address ?? '---' }}</span>
    </div>

    <div class="row">
        <span class="label">Goods Type</span>
        <span class="value">{{ [
    'Tài liệu' => 'Documents',
    'Quần áo' => 'Clothes',
    'Đồ điện tử' => 'Electronics',
    'Thực phẩm' => 'Food',
    'Hàng dễ vỡ' => 'Fragile Goods',
    'Khác' => 'Other',
][$courier->goods_type] ?? $courier->goods_type }}</span>
    </div>

    <div class="row">
        <span class="label">Weight</span>
        <span class="value">{{ $courier->total_weight }} kg</span>
    </div>

    <div class="row">
        <span class="label">Payment Method</span>
        <span class="value">COD - Cash on Delivery</span>
    </div>

    <div class="row">
        <span class="label">COD Amount</span>
        <span class="value amount">
            {{ number_format($courier->cod_amount ?? $courier->price ?? 0, 0, ',', '.') }} VNĐ
        </span>
    </div>

    <div class="row">
        <span class="label">Created Date</span>
        <span class="value">{{ $courier->created_at ? $courier->created_at->format('m/d/Y H:i') : now()->format('m/d/Y H:i') }}</span>
    </div>

    <div class="actions">
        <a href="{{ route('customer.orders.index') }}" class="btn btn-back">Back to Orders</a>
        <button onclick="window.print()" class="btn">Print Bill</button>
    </div>
</div>

</body>
</html>
