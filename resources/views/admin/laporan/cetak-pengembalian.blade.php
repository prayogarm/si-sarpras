<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Pengembalian Barang</h1>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama User</th>
                <th>Nama Barang</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalian as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->barang->nama_barang }}</td>
                <td>{{ $item->tanggal_pengembalian }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
