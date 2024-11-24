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
                <th>Tgl Produksi</th>
                <th>Kode Produksi</th>
                <th>Nama Barang</th>
                <th>Bahan Baku yang Digunakan</th>
                <th>Jumlah Pemakaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $produksi)
            @php $pemakaians = $produksi->pemakaian; @endphp
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $produksi->tanggalProduksi }}</td>
                <td>{{ $produksi->kodeProduksi }}</td>
                <td>{{ $produksi->namaBarang }}</td>

                @if($pemakaians->isNotEmpty())
                @php $pemakaian = $pemakaians->first(); @endphp
                <td>{{ $pemakaian->bahanBaku->namaBahanBaku }}</td>
                <td>{{ $pemakaian->jumlahPemakaian }}</td>

                <!-- Menampilkan pemakaian lainnya jika ada -->
                @foreach($pemakaians->skip(1) as $pemakaian)
            <tr>
                <!-- Kolom produksi kosong untuk pemakaian berikutnya -->
                <td colspan="4"></td>
                <td>{{ $pemakaian->bahanBaku->namaBahanBaku }}</td>
                <td>{{ $pemakaian->jumlahPemakaian }}</td>
            </tr>
            @endforeach
            @else
            <!-- Jika tidak ada pemakaian bahan baku -->
            <td colspan="6" style="text-align: center;">Tidak ada Pemakaian Bahan Baku</td>
            @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Laporan dibuat pada {{ date('H:i:s, d-m-Y') }}</p>
    </div>
</body>

</html>