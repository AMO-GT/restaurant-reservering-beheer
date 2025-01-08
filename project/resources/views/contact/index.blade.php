<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant - Contact</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Navigatie -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/images/logo.png" alt="M'n moeder" height="30">
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="https://www.fifty50tilburg.nl/wp-content/uploads/2021/06/Menukaart-Fifty50-new.pdf" target="_blank">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.tablemanager.com/nl/d/fifty50-tilburg-tilburg" target="_blank">Reserveren</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Sectie -->
    <div class="bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8">
                    <h1 class="display-4 mb-3">Contact</h1>
                    <p class="lead">Heeft u vragen of wilt u een reservering wijzigen?</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Informatie -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Wijzigingen en Annuleringen -->
                <div class="card shadow-sm mb-5">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-4">Wijzigen of Annuleren van uw Reservering</h2>
                        <p class="lead">Wij begrijpen dat plannen kunnen veranderen. U kunt uw reservering eenvoudig wijzigen of annuleren door contact met ons op te nemen.</p>
                        
                        <div class="alert alert-info mt-4">
                            <h3 class="h5"><i class="fas fa-info-circle me-2"></i>Hoe kunt u uw reservering wijzigen of annuleren?</h3>
                            <p class="mb-0">Bel ons op <strong><a href="tel:0612345678" class="text-decoration-none">06 12345678</a></strong> en houd de volgende gegevens bij de hand:</p>
                            <ul class="mt-2 mb-0">
                                <li>Uw naam</li>
                                <li>De datum van uw reservering</li>
                                <li>Het tijdstip van uw reservering</li>
                                <li>Het aantal personen</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contactgegevens -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <h3 class="h4 mb-4">Bereikbaarheid</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <i class="fas fa-phone me-2"></i>
                                        <a href="tel:0612345678" class="text-decoration-none">06 12345678</a>
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-envelope me-2"></i>
                                        <a href="mailto:info@restaurant.nl" class="text-decoration-none">info@restaurant.nl</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        Restaurantstraat 123<br>
                                        1234 AB Amsterdam
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <h3 class="h4 mb-4">Openingstijden</h3>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <strong>Maandag t/m Vrijdag</strong><br>
                                        17:00 - 22:00
                                    </li>
                                    <li>
                                        <strong>Zaterdag & Zondag</strong><br>
                                        16:00 - 23:00
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light mt-5 py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Restaurant Naam. Alle rechten voorbehouden.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>