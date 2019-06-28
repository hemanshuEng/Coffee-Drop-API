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
        <section id="nearestplace">
            <div class="text-center display-4 mb-2">Find Nearest Shop</div>
            <div class="row">

                <div class="col-md-6">
                    <form id="postcode-form" method="post" class="needs-validation mb-5 ">
                        <div class="form-group ">
                            <label for="postcode">Enter Your Post Code</label>
                            <input type="text" class="form-control" id="postcode" placeholder="Enter PostCode" required>
                        </div>
                        <button type="submit" class="btn btn-dark float-right">Find nearest shop</button>
                    </form>
                    <div id="address"></div>
                </div>
                <div class="col-md-6">
                    <div id="mapid-2"></div>
                </div>
            </div>

        </section>
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
                <button type="submit" class="btn btn-dark float-right">Create New Shop</button>
            </form>
            <div class="alert alert-success alert-dismissible fade" id="cashback-alert" role="alert">
                <h4 class="text-center " id='cashback-amount'></h4>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </section>
        <section id="newshop">
            <div class="text-center display-4 mb-2">Enter New Shop</div>
            <form id="newshop-form" method="post" class="needs-validation mb-5 ">
                @csrf
                <div class="form-group row">
                    <label for="postcode-1" class="col-sm-2 col-form-label">Enter Shop Postcode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="postcode-1" placeholder="Enter post Code" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-open-0" placeholder="Opening Time">
                        <small  class="form-text text-muted">Sunday opening time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-close-0" placeholder="Opening Time">
                        <small  class="form-text text-muted">Sunday closing time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-open-1" placeholder="Opening Time">
                        <small  class="form-text text-muted">Monday opening time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-close-1" placeholder="Opening Time">
                        <small  class="form-text text-muted"> Monday closing time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-open-2" placeholder="Opening Time">
                        <small  class="form-text text-muted">Tuesday opening time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-close-2" placeholder="Opening Time">
                        <small class="form-text text-muted"> Tuesday closing time</small>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-open-3" placeholder="Opening Time">
                        <small  class="form-text text-muted"> Wednesday opening time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-close-3" placeholder="Opening Time">
                        <small  class="form-text text-muted">Wednesday closing time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-open-4" placeholder="Opening Time">
                        <small  class="form-text text-muted">Thursday opening time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-close-4" placeholder="Opening Time">
                        <small  class="form-text text-muted">Thursday closing time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-open-5" placeholder="Opening Time">
                        <small  class="form-text text-muted">Friday opening time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-close-5" placeholder="Opening Time">
                        <small  class="form-text text-muted">Friday closing time</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-open-6" placeholder="Opening Time">
                        <small class="form-text text-muted">Saturday opening time</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="day-close-6" placeholder="Opening Time">
                        <small  class="form-text text-muted">Saturday closing time</small>
                    </div>
                </div>
                <div class="form-group row">

                </div>
                <button type="submit" class="btn btn-dark ">Enter New shop</button>
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
