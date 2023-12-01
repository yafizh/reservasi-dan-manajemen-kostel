<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Pembayaran</title>
    <style>
        .td-fit {
            width: 1%;
            white-space: nowrap;
        }

        table {
            width: 100%;
        }

        table,
        table tr td {
            border-collapse: collapse;
            border: 1px solid black;
            padding: .4rem;
        }

        table ol {
            padding: 0;
            margin: 0 0 0 1rem;
        }

        main {
            /* background-color: red; */
            margin: auto;
        }

        main h2 {
            text-align: center;
        }

        @page {
            size: 14cm 10cm;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>
    <?php
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        $temp = '';
        if ($nilai < 12) {
            $temp = ' ' . $huruf[$nilai];
        } elseif ($nilai < 20) {
            $temp = penyebut($nilai - 10) . ' belas';
        } elseif ($nilai < 100) {
            $temp = penyebut($nilai / 10) . ' puluh' . penyebut($nilai % 10);
        } elseif ($nilai < 200) {
            $temp = ' seratus' . penyebut($nilai - 100);
        } elseif ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . ' ratus' . penyebut($nilai % 100);
        } elseif ($nilai < 2000) {
            $temp = ' seribu' . penyebut($nilai - 1000);
        } elseif ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . ' ribu' . penyebut($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . ' juta' . penyebut($nilai % 1000000);
        } elseif ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . ' milyar' . penyebut(fmod($nilai, 1000000000));
        } elseif ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . ' trilyun' . penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
    
    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = 'minus ' . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil . ' Rupiah';
    }
    
    ?>
    <main>
        <h2>KWITANSI</h2>
        <table>
            <tr>
                <td class="td-fit">Telah terima dari</td>
                <td>: {{ $checkIn->name }}</td>
            </tr>
            <tr>
                <td class="td-fit">Uang sebesar</td>
                <td>: Rp. {{ number_format($checkIn->price(), 0, '.', '.') }}
                    <span style="text-transform: capitalize;">(<?= terbilang($checkIn->price()) ?>)</span>
                </td>
            </tr>
            <tr>
                <td class="td-fit">Untuk pembayaran</td>
                <td>: Periode {{ $period }}</td>
            </tr>
        </table>

        <div style="display: flex; justify-content: end; margin-top: 4rem; text-align: center;">
            <div>
                <div>Banjarbaru, {{ $today->day }} {{ $today->getTranslatedMonthName() }} {{ $today->year }}</div>
                <div>Penerima, </div>
                <br><br><br><br>
                <div>Admin</div>
            </div>
        </div>
    </main>
    <script>
        window.print();
    </script>
</body>

</html>
