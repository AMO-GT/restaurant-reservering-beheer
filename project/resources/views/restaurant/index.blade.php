<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Pagina</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Vaste Reserveer Knop */  
        .reserveer-knop {
            position: fixed;            /* Zet de knop op een vaste positie op het scherm */
            bottom: 20px;              /* 20px vanaf de onderkant van het scherm */
            right: 20px;               /* 20px vanaf de rechterkant van het scherm */ 
            z-index: 1050;             /* Zorgt dat de knop boven andere elementen zweeft */
        }

        /* Widget Container */
        #reserveer-widget {
            position: fixed;
            bottom: 100px; /* Verplaatst de widget naar de onderkant */
            right: -400px; /* Begin buiten het scherm */
            width: 350px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: right 0.5s ease-in-out;
            z-index: 1040;
        }

        #reserveer-widget.open {
            right: 20px; /* Schuift de widget in beeld */
        }

        .widget-header {
            background-color: #ff6b6b;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .widget-body {
            padding: 15px;
        }

        /* Alleen essentiële custom styles */
        .hero-section {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .menu-image {
            height: 250px;
            object-fit: cover;
        }

        .navbar-logo {
            height: 100px;
            width: auto;
            /* margin-right: 100px; */
        }

        .hero-logo {
            width: 5px;
            height: auto;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

<!-- Optie 2: Vaste navigatiebalk bovenaan -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Restaurant Logo" class="navbar-logo">
        </a>
        <!-- Optioneel: navigatie menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#over-ons">Over Ons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Hero Sectie -->
<div class="hero-section">
    <video class="hero-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/restaurant-bg.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay d-flex align-items-center justify-content-center text-white text-center">
        <!-- Alerts toevoegen binnen de hero-overlay -->
        @if (session('success'))
            <div class="alert alert-success text-center position-absolute top-0 start-50 translate-middle-x mt-4 w-45" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center position-absolute top-0 start-50 translate-middle-x mt-4 w-45" role="alert" id="error-alert">
                {{ session('error') }}
            </div>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    var successAlert = document.getElementById('success-alert');
                    if (successAlert) {
                        successAlert.style.display = 'none';
                    }
                    var errorAlert = document.getElementById('error-alert');
                    if (errorAlert) {
                        errorAlert.style.display = 'none';
                    }
                }, 3000); // 5000 milliseconden = 5 seconden
            });
        </script>
        
        <div>
            <h1 class="display-1 fw-bold mb-4">M'n moeder</h1>
            <p class="lead fs-3">Een culinaire ervaring om nooit te vergeten</p>
            <a href="#menu" class="btn btn-outline-light btn-lg mt-4">Ontdek ons menu</a>
        </div>
    </div>
</div>

<!-- Scrollbare Inhoud -->
<div class="bg-white position-relative">
    <!-- Menu Sectie -->
    <section id="menu" class="py-5">
        <div class="container">
            <h2 class="display-4 text-center mb-5">Onze Specialiteiten</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/gerecht1.jpg') }}" class="card-img-top menu-image rounded-top" alt="Gerecht 1">
                        <div class="card-body text-center">
                            <h3 class="card-title h4">Gerecht Naam</h3>
                            <p class="card-text text-muted">Beschrijving van het gerecht met de belangrijkste ingrediënten.</p>
                            <p class="card-text fw-bold">€24,50</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/gerecht2.jpg') }}" class="card-img-top menu-image rounded-top" alt="Gerecht 2">
                        <div class="card-body text-center">
                            <h3 class="card-title h4">Gerecht Naam</h3>
                            <p class="card-text text-muted">Beschrijving van het gerecht met de belangrijkste ingrediënten.</p>
                            <p class="card-text fw-bold">€22,50</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/gerecht3.jpg') }}" class="card-img-top menu-image rounded-top" alt="Gerecht 3">
                        <div class="card-body text-center">
                            <h3 class="card-title h4">Gerecht Naam</h3>
                            <p class="card-text text-muted">Beschrijving van het gerecht met de belangrijkste ingrediënten.</p>
                            <p class="card-text fw-bold">€26,50</p>
                        </div>
                    </div>
                </div>
        

            </div>
        </div>
    </section>

    <!-- Over Ons Sectie -->
    <section class="py-5 bg-light">
        <div class="container">
            <a name="over-ons"></a>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('images/over-ons.jpg') }}" class="img-fluid rounded shadow" alt="Restaurant interieur">
                </div>
                <div class="col-lg-6">
                    
                    <h2 class="display-4 mb-4">Over Ons</h2>
                    <p class="lead">Hier komt een uitgebreide beschrijving over het restaurant.</p>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="row g-4 text-center">
                        <div class="col-6">
                            <div class="p-4 bg-white rounded shadow-sm">
                                <h3 class="h2 mb-0">10+</h3>
                                <p class="text-muted mb-0">Jaren ervaring</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 bg-white rounded shadow-sm">
                                <h3 class="h2 mb-0">4.8</h3>
                                <p class="text-muted mb-0">Gemiddelde score</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Sectie -->
    <section class="py-5">
        <a name="contact"></a>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-4 mb-4">Contact</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded">
                                <i class="bi bi-geo-alt fs-1 text-danger mb-3"></i>
                                <h3 class="h5">Adres</h3>
                                <p class="mb-0">Restaurantstraat 123<br>1234 AB Amsterdam</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded">
                                <i class="bi bi-telephone fs-1 text-danger mb-3"></i>
                                <h3 class="h5">Telefoon</h3>
                                <p class="mb-0">020-1234567</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded">
                                <i class="bi bi-envelope fs-1 text-danger mb-3"></i>
                                <h3 class="h5">E-mail</h3>
                                <p class="mb-0">info@mijnmoeder.nl</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Vaste Reserveer Knop -->
<button type="button" class="btn btn-danger reserveer-knop" id="openWidgetBtn">
    Reserveren
</button>

<!-- Reserveringswidget -->
<div id="reserveer-widget">
    <div class="widget-header">
        Selecteer een restaurant
        <button type="button" class="btn-close btn-sm float-end text-white" id="closeWidgetBtn"></button>
    </div>
    <div class="widget-body">
        <!-- Bevestigingsbericht -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Foutmeldingen -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Reserveringsformulier -->
        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Naam</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="persons" class="form-label">Aantal Personen</label>
                <input type="number" id="persons" name="persons" class="form-control" min="1" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Datum</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Tijd</label>
                <select id="time" name="time" class="form-control" required>
                    <option value="">Selecteer een tijd</option>
                    @php
                        $start = strtotime('12:00');
                        $end = strtotime('22:00');
                        $interval = 15 * 60; // 15 minuten in seconden

                        for ($time = $start; $time <= $end; $time += $interval) {
                            echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . '</option>';
                        }
                    @endphp
                </select>
            </div>
            <button type="submit" class="btn btn-danger w-100">Reserveer Nu</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS en Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- JavaScript om de widget te tonen/verbergen -->
<script>
    document.getElementById('openWidgetBtn').addEventListener('click', function () {
        document.getElementById('reserveer-widget').classList.add('open');
    });

    document.getElementById('closeWidgetBtn').addEventListener('click', function () {
        document.getElementById('reserveer-widget').classList.remove('open');
    });
</script>



<!-- Optie 3: Footer logo -->
<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
                <img src="{{ asset('images/logo.png') }}" alt="Restaurant Logo" class="navbar-logo mb-3">
                <p>© 2024 Restaurant Naam. Alle rechten voorbehouden.</p>
            </div>
            <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
                <h5 class="text-uppercase mb-3 text-white">Openingstijden</h5>
                <ul class="list-unstyled text-white">
                    <li><strong>Maandag:</strong> <span>12:00 - 22:00</span></li>
                    <li><strong>Dinsdag:</strong> <span>12:00 - 22:00</span></li>
                    <li><strong>Woensdag:</strong> <span>12:00 - 22:00</span></li>
                    <li><strong>Donderdag:</strong> <span>12:00 - 22:00</span></li>
                    <li><strong>Vrijdag:</strong> <span>12:00 - 22:30</span></li>
                    <li><strong>Zaterdag:</strong> <span>12:00 - 22:30</span></li>
                    <li><strong>Zondag:</strong> <span>12:00 - 22:30</span></li>
                </ul>
            </div>
            <div class="col-md-4 text-center text-md-start">
                <h5 class="text-uppercase mb-3 text-white">Afhalen & Bezorgen</h5>
                <ul class="list-unstyled text-white">
                    <li><strong>Elke dag:</strong> <span>14:00 - 21:00</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
