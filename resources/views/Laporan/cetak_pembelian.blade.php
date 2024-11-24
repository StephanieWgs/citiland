<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pembelian dan Retur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background-color: #fff;
        }

        th {
            background-color: #1e88e5;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-size: 12px;
            border: 1px solid #e0e0e0;
        }

        td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            text-align: left;
            font-size: 12px;
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #f1f5f9;
        }

        tr:hover {
            background-color: #e3f2fd;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <h2>Rekap Pembelian dan Retur</h2>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th>Tgl Pembelian</th>
                <th>No. Invoice</th>
                <th>Supplier</th>
                <th>Nama Barang</th>
                <th>Jumlah Dibeli</th>
                <th>Total Pembelian</th>
                <th>Tgl Retur</th>
                <th>Jumlah Retur</th>
                <th>Alasan Retur</th>
                <th>Total Retur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $pembelian)
            @php $returs = $pembelian->retur; @endphp
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $pembelian->tanggalPembelian }}</td>
                <td>{{ $pembelian->noInv }}</td>
                <td>{{ $pembelian->supplier->namaSupplier }}</td>
                <td>{{ $pembelian->bahanBaku->namaBahanBaku }}</td>
                <td>{{ $pembelian->jumlahPembelian }}</td>
                <td>Rp{{ $pembelian->totalHarga }}</td>
                @if($returs->isNotEmpty())
                @php $retur = $returs->first(); @endphp
                <td>{{ $retur->tanggalRetur }}</td>
                <td>{{ $retur->jumlahRetur }}</td>
                <td>{{ $retur->alasan }}</td>
                <td>Rp{{ $retur->jumlahRetur * $pembelian->hargaBB }}</td>
                @else
                <td colspan="4" style="text-align: center;">Tidak ada retur</td>
                @endif
            </tr>
            @if($returs->count() > 1)
            @foreach($returs->skip(1) as $retur)
            <tr>
                <!-- Data pembelian kosong -->
                <td colspan="7"></td>
                <td>{{ $retur->tanggalRetur }}</td>
                <td>{{ $retur->jumlahRetur }}</td>
                <td>{{ $retur->alasan }}</td>
                <td>Rp{{ $retur->jumlahRetur * $pembelian->hargaBB }}</td>
            </tr>
            @endforeach
            @endif
            @endforeach
        </tbody>

    </table>
    <div class="footer">
        <p>Laporan dibuat pada {{ date('H:i:s, d-m-Y') }}</p>
    </div>
</body>

</html>