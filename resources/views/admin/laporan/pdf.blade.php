<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
    color: #1f2937;
}

.container {
    padding: 20px;
}

/* HEADER */
.header {
    display: table;
    width: 100%;
    margin-bottom: 20px;
}

.header-left {
    display: table-cell;
    vertical-align: middle;
}

.header-right {
    display: table-cell;
    text-align: right;
    vertical-align: middle;
}

.logo {
    width: 60px;
}

.title {
    font-size: 18px;
    font-weight: bold;
}

.subtitle {
    font-size: 11px;
    color: #6b7280;
}

/* SECTION */
.section {
    margin-bottom: 20px;
}

.label {
    color: #6b7280;
    font-size: 11px;
}

/* SUMMARY BOX */
.summary {
    margin-top: 10px;
    border: 1px solid #e5e7eb;
    padding: 10px;
}

.summary-row {
    display: table;
    width: 100%;
    margin-bottom: 5px;
}

.summary-left {
    display: table-cell;
}

.summary-right {
    display: table-cell;
    text-align: right;
    font-weight: bold;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #f3f4f6;
    font-size: 11px;
    text-transform: uppercase;
    padding: 8px;
    text-align: left;
}

td {
    padding: 8px;
    border-bottom: 1px solid #e5e7eb;
}

.right {
    text-align: right;
}

.center {
    text-align: center;
}

/* FOOTER */
.footer {
    margin-top: 30px;
    font-size: 10px;
    color: #6b7280;
    text-align: center;
}
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="header-left">
            <img src="{{ public_path('pdf.png') }}" class="logo">
        </div>

        <div class="header-right">
            <div class="title">LAPORAN PENJUALAN</div>
            <div class="subtitle">
                Periode: {{ $from ?? '-' }} - {{ $to ?? '-' }}
            </div>
        </div>

    </div>

    <!-- SUMMARY -->
    <div class="section">

        <div class="label">Ringkasan</div>

        <div class="summary">

            <div class="summary-row">
                <div class="summary-left">Total Pendapatan</div>
                <div class="summary-right">
                    Rp {{ number_format($totalPendapatan) }}
                </div>
            </div>

            <div class="summary-row">
                <div class="summary-left">Total Pesanan</div>
                <div class="summary-right">
                    {{ $totalPesanan }}
                </div>
            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="section">

        <div class="label">Detail Transaksi</div>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Customer</th>
                    <th class="right">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pesanans as $p)
                <tr>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                    <td>#{{ $p->kode }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td class="right">
                        Rp {{ number_format($p->total_bayar) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak pada {{ now()->format('d M Y H:i') }}
    </div>

</div>

</body>
</html>