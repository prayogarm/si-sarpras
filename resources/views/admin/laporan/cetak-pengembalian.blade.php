<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian Barang</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
            margin-bottom: 5px;
        }
        .kop-surat {
            position: relative;
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 75px;
            margin-bottom: 20px;
            height: 100px;
        }
        .logo-kiri {
            position: absolute;
            left: 0;
            top: 10;
            width: 115px;
            height: auto;
        }
        .logo-kanan {
            position: absolute;
            right: 5;
            top: 20;
            width: 70px;
            height: auto;
        }
        .kop-text {
            margin: 0 94px;
            padding-top: 10px;
        }
        .kop-text h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .kop-text p {
            margin: 0;
            font-size: 10px;
            line-height: 1.1;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{ public_path('assets/img/logo.png') }}" alt="Logo Kiri" class="logo-kiri">
        <div class="kop-text">
            <H5 style="margin: 0; font-size:12px">YAYASAN PEMBINA LEMBAGA PENDIDIKAN (YPLP) PGRI PROVINSI RIAU</H5>
            <H5 style="margin: 0; font-size:14px">SEKOLAT MENENGAH KEJURUAN</H5>
            <h2 style="font-size: 30px; margin:0">SMK PGRI PEKANBARU</h2>
            <p>(BIDANG KEAHLIAN: BISNIS MANAJEMEN, TEKNOLOGI INFORMASI DAN KOMUNIKASI, PARIWISATA, SENI DAN EKONOMI KREATIF)</p>
            <p>Program Keahlian: Akuntansi dan Keuangan Lembaga (AKL) Manajemen Perkantoran dan Layanan Bisnis (MPLB)
                Perbankan Syariah (PBS) Bisnis Daring Pemasaran (BDP) Teknik Jaringan Komputer dan Telekomunikasi (TJKT)
                Pengembangan Perangkat Lunak dan Gim (PPLG) Usaha Layanan Pariwisata (UPL) Desain Komunikasi Visual (DKV)
            </p>
            <h4 style="margin-top: 9">TERAKREDITASI A</h4>
        </div>
        <img src="{{ public_path('assets/img/logoriau.png') }}" alt="Logo Kanan" class="logo-kanan">
    </div>
    
    <h1>Laporan Pengembalian Barang</h1>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama User</th>
                <th>Nama Barang</th>
                <th>Tanggal Peminjaman</th>
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
                <td>{{ $item->pengajuan->tanggal_pengajuan }}</td>
                <td>{{ $item->tanggal_pengembalian }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 style="padding-top: 50px;padding-left:30px">Waka Sapras</h5>
    <h5 style="padding-top: 50px;padding-left:30px">Erfin Fajri, SE</h5>
    
</body>
</html>
