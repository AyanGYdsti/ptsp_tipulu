<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px
        }

        p {
            margin: 0;
            font-size: 14px
        }

        th,
        td {
            font-size: 14px
        }

        table {
            width: 100%
        }
    </style>
</head>

<body>
    <table style="border-bottom:2px solid black">
        <tr>
            {{-- Kolom kiri: logo --}}
            <td style="width: 25%; text-align: center; vertical-align: middle;">
                <img src="data:image/webp;base64,{{ base64_encode(file_get_contents(public_path('assets/img/logo.webp'))) }}"
                    alt="Logo" width="80" height="80">
            </td>

            {{-- Kolom tengah: teks --}}
            <td style="width: 50%; text-align: center; vertical-align: middle;">
                <p style="font-size: 20px; margin: 2px 0; font-weight: bold;">PEMERINTAH KOTA KENDARI</p>
                <p style="font-size: 16px; margin: 2px 0;">KECAMATAN KENDARI BARAT</p>
                <p style="font-size: 16px; margin: 2px 0;">KELURAHAN TIPULU</p>
                <p style="margin: 2px 0;">JL. SERIGALA NO.2 TLP.(0401) 331891 KODE POS 93122</p>
            </td>

            {{-- Kolom kanan: kosong --}}
            <td style="width: 25%;"></td>
        </tr>
    </table>

    <div style="text-align:center;margin:20px 0">
        <p><span style="border-bottom:2px solid black">{{ $judul }}</span></p>
        <p>Nomor : 302 / / I /{{ $tahun }}</p>
    </div>

    <p>
        Yang bertanda tangan di bawah ini, Lurah Tipulu Kecamatan Kendari Barat Kota Kendari, dengan ini menerangkan
        bahwa :
    </p>
    <br>
    <table>
        <tr>
            <td style="width: 20%">NIK</td>
            <td style="width: 5%">:</td>
            <td>{{ $nik }}</td>
        </tr>

        <tr>
            <td style="width: 20%">Nama</td>
            <td style="width: 5%">:</td>
            <td>{{ $nama_pengaju }}</td>
        </tr>
        <tr>
            <td style="width: 20%">Tempat / Tanggal Lahir</td>
            <td style="width: 5%">:</td>
            <td>{{ $tempat_lahir }}, {{ $tanggal_lahir }}</td>
        </tr>
        <tr>
            <td style="width: 20%">Agama</td>
            <td style="width: 5%">:</td>
            <td>{{ $agama }}</td>
        </tr>
        <tr>
            <td style="width: 20%">Pekerjaan</td>
            <td style="width: 5%">:</td>
            <td>{{ $pekerjaan }}</td>
        </tr>
        <tr>
            <td style="width: 20%">Alamat</td>
            <td style="width: 5%">:</td>
            <td>{{ $alamat }}</td>
        </tr>

        <tr>
            <td style="width: 20%">Jenis Kelamin</td>
            <td style="width: 5%">:</td>
            <td>{{ $jenis_kelamin }}</td>
        </tr>

        
    </table>
    <br>
    <p>
        Adalah benar-benar warga Kelurahan Tipulu untuk membuat Surat Kelakuan Baik.
    </p>
    <br>
    <p>
        Demikian Surat Keterangan ini dibuat dengan sebenar-benarnya untuk dipergunakan seperlunya.
    </p>

    <table style="text-align: center;margin-top:30px">
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%">Kendari, {{ $tanggal }}</td>
        </tr>
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%">
                <p>AN. LURAH TIPULU</p><br>
                <p>KASI. TRANTIB</p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <br>
                <br>
                <br>
                <br>
                Andika
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                NIP. 19681027 199008 2 002
            </td>
        </tr>
    </table>
</body>

</html>
