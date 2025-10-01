<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat</title>

    <style>
        @page {
            font-family: 'Times New Roman', Times, serif, Helvetica, sans-serif;
            margin-left: 2.86cm;
            margin-right: 1.59cm;
            margin-top: 0.75cm;
            margin-bottom: 2.54cm;
            line-height: 1.5;
            width: 21.59cm;
            height: 35.56cm;
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
        <p>Nomor : 302 / / I /{{ $tahun }}</p>{{-- Masih mau di ganti  --}}
    </div>

    <p style="text-align: justify; text-indent: 27px;">
        Yang bertanda tangan di bawah ini, Lurah Tipulu Kecamatan Kendari Barat Kota Kendari, dengan ini menerangkan
        bahwa :
    </p>
    <br>


    @if ($judul == 'Surat Keterangan Kematian')

        <table style="margin-left:27px">
            <tr>
                <td style="width: 27%">Nama</td>
                <td style="width: 2%">:</td>
                <td>{{ $nama_md }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $jenis_kelamin_md }}</td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>:</td>
                <td>{{ $umur }} Tahun</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat_md }}</td>
            </tr>

            <tr>
                <td>Telah Meninggal Dunia Pada</td>
                <td>:</td>
                <td></td>
            </tr>

            {{-- FIXED: Changed <tdr> to a valid <tr> tag --}}
            <tr>
                <td style="padding-left: 15px;">Hari</td>
                <td>:</td>
                <td>{{ $hari_meninggal }}</td>
            </tr>

            <tr>
                <td style="padding-left: 15px;">Tanggal</td>
                <td>:</td>
                <td>{{ $tanggal_meninggal }}</td>
            </tr>

            <tr>
                <td style="padding-left: 15px;">Di</td>
                <td>:</td>
                <td>{{ $tempat_meninggal }}</td>
            </tr>

            <tr>
                <td>Disebabkan Karena</td>
                <td>:</td>
                <td>{{ $penyebab_md }}</td>
            </tr>

            <tr>
                <td>Yang Melaporkan</td>
                <td>:</td>
                <td>{{ $nama_pengaju }}</td>
            </tr>
        </table>

        <br>
        <p style="text-align: justify; text-indent: 27px;">
            Demikian Surat Keterangan ini diberikan kepada keluarga Almarhum untuk dipergunakan seperlunya.
        </p>



    @elseif ($judul == 'Surat Keterangan Pindah')

        {{-- FIXED: Restructured this entire table to be valid HTML --}}
        <table style="margin-left:27px">
            <tr>
                <td style="width: 27%">NIK</td>
                <td style="width: 2%">:</td>
                <td>{{ $nik }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $nama_pengaju }}</td>
            </tr>
            <tr>
                <td>Tempat / Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $tempat_lahir }}, {{ $tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $agama }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $pekerjaan }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>{{ $status }}</td>
            </tr>
            <tr>
                <td>Alamat Asal</td>
                <td>:</td>
                <td>{{ $alamat }}</td>
            </tr>
            <tr>
                <td>Pindah Ke</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td style="padding-left: 15px;">Desa/Kelurahan</td>
                <td>:</td>
                <td>{{ $desa_kelurahan }}</td>
            </tr>
            <tr>
                <td style="padding-left: 15px;">Kecamatan</td>
                <td>:</td>
                <td>{{ $kecamatan }}</td>
            </tr>
            <tr>
                <td style="padding-left: 15px;">Kab/Kota</td>
                <td>:</td>
                <td>{{ $kab_kota }}</td>
            </tr>
            <tr>
                <td style="padding-left: 15px;">Provinsi</td>
                <td>:</td>
                <td>{{ $provinsi }}</td>
            </tr>
            <tr>
                <td>Tanggal Pindah</td>
                <td>:</td>
                <td>{{ $tgl_pindah }}</td>
            </tr>
            <tr>
                <td>Alasan Pindah</td>
                <td>:</td>
                <td>{{ $alasan_pindah }}</td>
            </tr>
            <tr>
                <td>Pengikut</td>
                <td>:</td>
                <td>{{ $pengikut }} Orang</td>
            </tr>
        </table>


    @else


        <table style="margin-left:27px">

            @if ($judul == 'Kartu Keluarga')
                <tr>
                    <td style="width: 27%">Nama Kepala Keluarga</td>
                    <td style="width: 2%">:</td>
                    <td>{{ $nama_kepala_keluarga }}</td>
                </tr>
            @endif

            <tr>
                <td style="width: 27%">NIK</td>
                <td style="width: 2%">:</td>
                <td>{{ $nik }}</td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $nama_pengaju }}</td>
            </tr>
            <tr>
                <td>Tempat / Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $tempat_lahir }}, {{ $tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $agama }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $pekerjaan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $alamat }}</td>
            </tr>

            @if ($judul == 'Domisili Usaha dan Yayasan' || $judul == 'Surat Keterangan Memiliki Usaha' || $judul == 'Surat Keterangan Domisili Usaha')
                <tr>
                    <td>Nama Usaha / Yayasan</td>
                    <td>:</td>
                    <td>{{ $nama_usaha }}</td>
                </tr>
            @elseif ($judul == 'Surat Izin Keramaian')
                <tr>
                    <td>Nama Kegiatan</td>
                    <td>:</td>
                    <td>{{ $nama_kegiatan }}</td>
                </tr>


            @elseif ($judul == 'Kartu Keluarga')
                <tr>
                    <td>Kode Pos</td>
                    <td>:</td>
                    <td>93122</td>
                </tr>

                <tr>
                    <td>Jenis Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $jenis_pekerjaan }}</td>
                </tr>

                <tr>
                    <td>Golongan Darah</td>
                    <td>:</td>
                    <td>{{ $golongan_darah }}</td>
                </tr>
            @endif
        </table>
        <br>
        <p style="text-align: justify; text-indent: 27px;">
            Nama yang tersebut diatas adalah benar - benar penduduk di RT ??/ RW ?? Kelurahan Tipulu Kecamatan Kendari
            Barat dan sepanjang pengetahuan kami {{ $keterangan_surat }}
        </p>

        @if ($judul == 'Pembenaran Nama KTP')
            {{-- masih mau di diskusikan --}}
        @endif

        <br>
        <p style="text-align: justify; text-indent: 27px;">
            Demikian Surat Keterangan ini dibuat dengan sebenar-benarnya untuk dipergunakan seperlunya.
        </p>

    @endif

    <table style="text-align: center;margin-top:30px">
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%">Kendari, {{ $tanggal }}</td>
        </tr>
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%">
                <p>AN. LURAH TIPULU</p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <br>
                <br>
                <br>
                <br>
                <p>{{ $aparatur }}</p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <p style="border-bottom: 1px solid black; display: inline-block; padding-bottom: 1px;">
                    NIP. 19681027 199008 2 002
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
