<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bismillah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-3">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu kiri -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ 'dasboard' }}">Dasboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ 'produks' }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ 'suppliers' }}">Supplier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ 'kategoris' }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ 'shop' }}">Toko</a>
                </li>
            </ul>

            <!-- Menu kanan -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ 'login' }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <main class="py-5">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
