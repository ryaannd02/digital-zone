<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #1f2937;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .section {
            margin-bottom: 20px;
        }

        .label {
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f4f6;
            text-align: left;
            padding: 8px;
            font-size: 11px;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .total-box {
            margin-top: 10px;
            width: 100%;
        }

        .total-row td {
            padding: 6px;
        }

        .grand-total {
            font-weight: bold;
            font-size: 14px;
        }

        .right {
            text-align: right;
        }

        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 20px 0;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="title">INVOICE</div>
            <div>#{{ $pesanan->kode }}</div>
        </div>

        <div class="right">
            <div class="label">Tanggal</div>
            <div>{{ $pesanan->created_at->format('d M Y') }}</div>
        </div>
    </div>

    <!-- CUSTOMER -->
    <div class="section">
        <div class="label">Customer</div>
        <div><b>{{ $pesanan->user->name }}</b></div>
    </div>

    <!-- STATUS -->
    <div class="section">
        <div class="label">Status Pesanan</div>
        <div>{{ ucfirst($pesanan->order_status) }}</div>
    </div>

    <div class="divider"></div>

    <!-- TABLE -->
    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="right">Harga</th>
                    <th class="right">Qty</th>
                    <th class="right">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pesanan->details as $d)
                <tr>
                    <td>{{ $d->produk->nama_produk }}</td>
                    <td class="right">Rp {{ number_format($d->harga) }}</td>
                    <td class="right">{{ $d->qty }}</td>
                    <td class="right">Rp {{ number_format($d->harga * $d->qty) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="divider"></div>

    <!-- TOTAL -->
    <table class="total-box">
        <tr class="total-row">
            <td class="label">Total Harga</td>
            <td class="right">Rp {{ number_format($pesanan->total_harga) }}</td>
        </tr>

        <tr class="total-row">
            <td class="label">Ongkir</td>
            <td class="right">Rp {{ number_format($pesanan->ongkir) }}</td>
        </tr>

        <tr class="total-row grand-total">
            <td>Total Bayar</td>
            <td class="right">Rp {{ number_format($pesanan->total_bayar) }}</td>
        </tr>
    </table>

</div>

</body>
</html>