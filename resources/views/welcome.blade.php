<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
    <!-- Styles -->
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark  bg-dark">
            <a class="navbar-brand" href="#">CoffeeDrop</a>
        </nav>
    </header>
    <div class="container">
        <section class="cashback">
            <div class="text-center display-4 mb-2">Cashback</div>
            <form id="cashback-form" method="post" class="needs-validation mb-5 ">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="ristretto">Ristretto</label>
                        <input type="number" class="form-control" id="ristretto" placeholder="Enter Quantity" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="espresso">Espresso</label>
                        <input type="number" class="form-control" id="espresso" placeholder="Enter Quantity" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lungo">Lungo</label>
                        <input type="number" class="form-control" id="lungo" placeholder="Enter Quantity" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark float-right">Submit</button>
            </form>

        </section>
        <section id="coffeedrop-shop">
            <div class="text-center display-4 mb-2">CoffeeDrop Shops</div>
            <div id="mapid"></div>
        </section>
    </div>

    <script src="{{ asset('js/app.js')}}"></script>
</body>

</html>
