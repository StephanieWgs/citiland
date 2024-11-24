<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Karyawan Staff Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            font-size: 26px;
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
            font-size: 16px;
            border: 1px solid #e0e0e0;
        }

        td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            text-align: left;
            font-size: 14px;
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
    <h2>List Karyawan Staff Admin</h2>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $admin)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $admin->nama }}</td>
                <td>{{ $admin->noHp }}</td>
                <td>{{ $admin->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Laporan dibuat pada {{ date('H:i:s, d-m-Y') }}</p>
    </div>
</body>

</html>