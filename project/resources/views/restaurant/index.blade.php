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
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
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
    </style>
</head>
<body>
<!-- Pagina Inhoud -->
<div class="container mt-5">
    <h1 class="text-center">Welkom bij het Restaurant</h1>
    <p class="text-center">Geniet van onze heerlijke gerechten en reserveer nu!</p>
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
                <input type="time" id="time" name="time" class="form-control" required>
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
</body>
</html>
