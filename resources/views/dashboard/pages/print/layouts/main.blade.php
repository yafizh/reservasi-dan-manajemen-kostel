<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="text-center p-4">
        <img src="/logo.png" alt="Logo" width="120" style="position: absolute; left: 20px;">
        <h4>GRAHA PUTIH</h4>
        Jl. Bayam No.62, Syamsudin Noor, Kec. Landasan Ulin, 
        <br>
        Kota Banjar Baru, Kalimantan Selatan 70721
        <br>
        Telepon: 0813-4647-6611, Website: https://grahaputih.com,
    </header>
    <div class="d-flex flex-column justify-content-center w-100">
        <div style="width: 100%; border-top: 3px solid black;"></div>
    </div>
    @yield('content')
    <footer class="d-flex justify-content-end py-4">
        @php $today = new \Carbon\Carbon(); @endphp
        <div class="text-center">
            <h6>Banjarbaru,
                {{ $today->day . ' ' . $today->locale('ID')->getTranslatedMonthName() . ' ' . $today->year }}
            </h6>
            <br><br><br><br><br>
            <h6>ADMIN</h6>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.print();
    </script>
</body>

</html>
