<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Data Pelatih</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        html {
            margin: 0px
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: auto;
            height: auto;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            /* text-align: center; */
            margin-bottom: 0px;
        }

        #logo img {
            width: 80px;
            margin-left: 50px
        }

        h1 {
            /* border-top: 1px solid #5D6975; */
            /* border-bottom: 1px solid #5D6975; */
            color: #000000;
            font-size: 1.5em;
            /* line-height: 1.4em; */
            font-weight: normal;
            text-align: center;
            /* margin: 0 0 0 0; */
            /* background: url(dimension.png); */
        }

        #project {
            float: left;
        }

        #project span {
            color: #000000;
            text-align: right;
            width: 52px;
            margin-right: 50px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            /* float: left; */
            text-align: right;
        }

        #project div,
        #company div {
            padding-right: 50px;
            white-space: nowrap;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table th {
            padding: 5px 20px;
            color: #000000;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        .table .service,
        .table .desc {
            text-align: left;
        }

        .table td {
            padding: 20px;
            text-align: right;

        }

        .table td.service,
        .table td.desc {
            vertical-align: top;
        }

        .table td.unit,
        .table td.qty,
        .table td.total {
            font-size: 1.2em;
        }

        .table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        .row {
            display: flex;
        }

        .column {
            flex: 50%;
        }

    </style>
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/pdf/style.css') }}" media="all" /> --}}
</head>

<body>
    <header class="clearfix">
        <div class="row">
            <div class="column">
                <div id="logo">
                    <img style="margin-bottom: -70px"
                        src="{{ public_path('assets/images/other-images/logo-login.png') }}">
                </div>
            </div>
            <div class="column">
                <h1 style="margin-top:0px;margin-bottom:0px;">SEKOLAH SEPAK BOLA (SSB)</h1>
                <h1 style="margin-top:0px;margin-bottom:0px;">INDONESIA MUDA (IM) PURWOKERTO</h1>
                <p style="text-align: center;margin-top:0px;margin-bottom:0px;">Alamat Sekretariat: Warung Lesehan Tirta
                    Aji</p>
                <p style="text-align: center;margin-top:0px;margin-bottom:0px;">Jalan Dr. Angka Purwokerto No. Telp/HP
                    085742767981</p>
            </div>
        </div>
        <hr style="margin-right:50px;margin-left:50px;" />
        <div class="row">
            <div class="column">
                <h4 style="text-align: center;margin-top:0px;margin-bottom:0px;">DATA PELATIH</h4>
                <h4 style="text-align: center;margin-top:0px;margin-bottom:0px;">SEKOLAH SEPAK BOLA (SSB) INDONESIA MUDA
                    PURWOKERTO</h4>
                {{-- <h4 style="text-align: center;margin-top:0px;margin-bottom:10px;">TAHUN
                    {{ date('Y') - 1 . '/' . date('Y') }}</h4> --}}
            </div>
        </div>
    </header>
    <main style="margin-left: 50px;margin-right:50px">
        <table class="table">
            <thead>
                <tr>
                    <th class="service" style="text-align: center">NAMA LENGKAP</th>
                    <th class="desc" style="text-align: center">JENIS KELAMIN</th>
                    <th style="text-align: center">ALAMAT</th>
                    <th style="text-align: center">KODE KELAS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($instructors as $item)
                    <tr>
                        <td class="service" style="text-align: center">
                            {{ $item->name }}</td>
                        <td class="desc" style="text-align: center">
                            {{ $item->gender }}</td>
                        <td class="unit" style="text-align: center">{{ $item->address }}</td>
                        <td class="total" style="text-align: center">
                            {{ $item->class->class->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
