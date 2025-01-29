<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Keuken Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #e74c3c;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #c0392b;
            --light: #ecf0f1;
        }

        body {
            background-color: var(--light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: var(--primary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }

        .card-header {
            background-color: white;
            border-bottom: 2px solid var(--secondary);
            border-radius: 10px 10px 0 0 !important;
        }

        .menu-category {
            color: var(--secondary);
            font-weight: 600;
            border-bottom: 2px solid var(--secondary);
            padding-bottom: 0.5rem;
            margin: 1.5rem 0 1rem 0;
        }

        .menu-item {
            padding: 0.5rem 0;
        }

        .form-check-input:checked {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .status-badge {
            padding: 0.4em 1em;
            border-radius: 20px;
            font-weight: 500;
        }

        .status-pending {
            background-color: var(--warning);
            color: white;
        }

        .status-completed {
            background-color: var(--success);
            color: white;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background-color: #34495e;
        }

        .btn-success {
            background-color: var(--success);
            border: none;
        }

        .btn-danger {
            background-color: var(--danger);
            border: none;
        }

        .order-card.completed {
            opacity: 0.8;
        }

        .menu-card {
            max-height: 500px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--secondary) #fff;
        }

        .menu-card::-webkit-scrollbar {
            width: 6px;
        }

        .menu-card::-webkit-scrollbar-track {
            background: #fff;
        }

        .menu-card::-webkit-scrollbar-thumb {
            background-color: var(--secondary);
            border-radius: 20px;
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid var(--secondary);
            display: inline-block;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .list-unstyled li {
            padding: 0.3rem 0;
            border-bottom: 1px solid #eee;
        }

        .list-unstyled li:last-child {
            border-bottom: none;
        }

        .timer-running {
            animation: pulse 1s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .timer-display {
            font-family: monospace;
            font-size: 1.2em;
            font-weight: bold;
            color: var(--primary);
            background: #f8f9fa;
            padding: 0.3rem 0.8rem;
            border-radius: 5px;
            margin-right: 10px;
        }

        .preparation-time {
            font-size: 0.9em;
            color: #666;
        }

        .drinks-container {
            overflow: hidden;
        }
    </style>
</head>
<body>
    @include('layouts.nav')
    
    <div class="container mt-4">
        <!-- Formulier voor nieuwe bestelling -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nieuwe Bestelling</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kitchen.orders.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_name" class="form-label">
                                <i class="fas fa-user me-2"></i>Klantnaam
                            </label>
                            <input type="text" class="form-control" name="customer_name" required>
                        </div>
                        
                        <!-- Vervang alleen het menu-gedeelte binnen de form -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-clipboard-list me-2"></i>Selecteer gerechten
                            </label>
                            <div class="card menu-card">
                                <div class="card-body">
                                    <!-- Voorgerechten -->
                                    <h6 class="menu-category">
                                        <i class="fas fa-cheese me-2"></i>Voorgerechten
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Carpaccio" id="carpaccio">
                                                <label class="form-check-label" for="carpaccio">
                                                    Rundercarpaccio met truffelmayonaise
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Tomatensoep" id="tomatensoep">
                                                <label class="form-check-label" for="tomatensoep">
                                                    Tomatensoep met basilicum
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Gamba's" id="gambas">
                                                <label class="form-check-label" for="gambas">
                                                    Gebakken gamba's in knoflookolie
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Bruschetta" id="bruschetta">
                                                <label class="form-check-label" for="bruschetta">
                                                    Bruschetta met tomaat en basilicum
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Salade" id="salade">
                                                <label class="form-check-label" for="salade">
                                                    Geitenkaas salade met honing
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hoofdgerechten -->
                                    <h6 class="menu-category">
                                        <i class="fas fa-utensils me-2"></i>Hoofdgerechten
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Biefstuk" id="biefstuk">
                                                <label class="form-check-label" for="biefstuk">
                                                    Biefstuk met champignonsaus
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Zalm" id="zalm">
                                                <label class="form-check-label" for="zalm">
                                                    Gegrilde zalm met citroenboter
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Pasta Carbonara" id="pasta">
                                                <label class="form-check-label" for="pasta">
                                                    Pasta Carbonara
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Risotto" id="risotto">
                                                <label class="form-check-label" for="risotto">
                                                    Paddenstoelen Risotto (Vegetarisch)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Schnitzel" id="schnitzel">
                                                <label class="form-check-label" for="schnitzel">
                                                    Wiener Schnitzel
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Kipsaté" id="kipsate">
                                                <label class="form-check-label" for="kipsate">
                                                    Kipsaté met pindasaus
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bijgerechten -->
                                    <h6 class="menu-category">
                                        <i class="fas fa-carrot me-2"></i>Bijgerechten
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Friet" id="friet">
                                                <label class="form-check-label" for="friet">
                                                    Verse friet
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Salade" id="bijsalade">
                                                <label class="form-check-label" for="bijsalade">
                                                    Gemengde salade
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Groenten" id="groenten">
                                                <label class="form-check-label" for="groenten">
                                                    Seizoensgroenten
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Desserts -->
                                    <h6 class="menu-category">
                                        <i class="fas fa-ice-cream me-2"></i>Desserts
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Tiramisu" id="tiramisu">
                                                <label class="form-check-label" for="tiramisu">
                                                    Huisgemaakte Tiramisu
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Cheesecake" id="cheesecake">
                                                <label class="form-check-label" for="cheesecake">
                                                    New York Cheesecake
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Chocoladetaart" id="chocoladetaart">
                                                <label class="form-check-label" for="chocoladetaart">
                                                    Warme chocoladetaart
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check menu-item">
                                                <input class="form-check-input" type="checkbox" name="items[]" value="Sorbet" id="sorbet">
                                                <label class="form-check-label" for="sorbet">
                                                    Sorbet-ijs van seizoensfruit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Bestelling Toevoegen
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Bestellingen -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h3 class="section-title">
                    <i class="fas fa-clock me-2"></i>Actieve Bestellingen
                </h3>
                @foreach ($orders as $order)
                    @if($order->status == 'In behandeling')
                        <div class="card mb-3 order-card" id="order-{{ $order->id }}">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-receipt me-2"></i>Bestelling #{{ $order->id }} - {{ $order->customer_name }}</span>
                                <span class="status-badge status-pending">{{ $order->status }}</span>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="timer-display" id="display-{{ $order->id }}">
                                        @php
                                            $prepTimes = [
                                                'Carpaccio' => 8,
                                                'Tomatensoep' => 10,
                                                "Gamba's" => 12,
                                                'Bruschetta' => 7,
                                                'Salade' => 8,
                                                'Biefstuk' => 15,
                                                'Zalm' => 12,
                                                'Pasta Carbonara' => 15,
                                                'Risotto' => 20,
                                                'Schnitzel' => 12,
                                                'Kipsaté' => 15,
                                                'Friet' => 8,
                                                'Groenten' => 8,
                                                'Tiramisu' => 5,
                                                'Cheesecake' => 5,
                                                'Chocoladetaart' => 7,
                                                'Sorbet' => 3,
                                            ];
                                            
                                            $items = explode(', ', $order->items);
                                            $totalTime = 0;
                                            foreach ($items as $item) {
                                                $itemName = explode(' met ', $item)[0];
                                                $totalTime += $prepTimes[$itemName] ?? 10;
                                            }
                                            $averageTime = ceil($totalTime / count($items));
                                        @endphp
                                        {{ sprintf('%02d:00', $averageTime) }}
                                    </span>
                                    <button type="button" 
                                            class="btn btn-primary" 
                                            id="timer-{{ $order->id }}"
                                            onclick="startOrderTimer({{ $order->id }}, {{ $averageTime }})">
                                        <i class="fas fa-play me-2"></i>Start Bereiding
                                    </button>
                                </div>

                                <p><strong><i class="fas fa-utensils me-2"></i>Gerechten:</strong></p>
                                <ul class="list-unstyled">
                                    @foreach ($items as $item)
                                        <li>
                                            <i class="fas fa-check me-2"></i>{{ $item }}
                                            <span class="preparation-time">
                                                @php
                                                    $itemName = explode(' met ', $item)[0];
                                                    $prepTime = $prepTimes[$itemName] ?? 10;
                                                @endphp
                                                <i class="fas fa-clock me-1"></i>{{ $prepTime }} min
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>

                                <p class="text-muted mb-3">
                                    <i class="fas fa-clock me-2"></i>
                                    <small>Aangemaakt: {{ $order->created_at->format('d-m-Y H:i') }}</small>
                                </p>

                                <div class="d-flex gap-2">
                                    <form action="{{ route('kitchen.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check me-2"></i>Markeer als Klaar
                                        </button>
                                    </form>

                                    <form action="{{ route('kitchen.orders.destroy', $order->id) }}" method="POST" 
                                          onsubmit="return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash me-2"></i>Verwijder
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="col-md-6">
                <h3 class="section-title">
                    <i class="fas fa-check-circle me-2"></i>Voltooide Bestellingen
                </h3>
                @foreach ($orders as $order)
                    @if($order->status == 'Klaar')
                        <div class="card mb-3 order-card completed" id="order-{{ $order->id }}">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-receipt me-2"></i>Bestelling #{{ $order->id }} - {{ $order->customer_name }}</span>
                                <span class="status-badge status-completed">{{ $order->status }}</span>
                            </div>
                            <div class="card-body">
                                <p><strong><i class="fas fa-utensils me-2"></i>Gerechten:</strong></p>
                                <ul class="list-unstyled">
                                    @foreach (explode(', ', $order->items) as $item)
                                        <li><i class="fas fa-check me-2"></i>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-clock me-2"></i>
                                    <small>Aangemaakt: {{ $order->created_at->format('d-m-Y H:i') }}</small>
                                </p>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('kitchen.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fas fa-undo me-2"></i>Terug naar In behandeling
                                        </button>
                                    </form>

                                    <form action="{{ route('kitchen.orders.destroy', $order->id) }}" method="POST" 
                                          onsubmit="return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash me-2"></i>Verwijder
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const timers = {};
        
        function startOrderTimer(orderId, totalTime) {
            const buttonId = `timer-${orderId}`;
            const button = document.getElementById(buttonId);
            const displayId = `display-${orderId}`;
            const display = document.getElementById(displayId);
            
            if (timers[buttonId]) {
                // Stop timer
                clearInterval(timers[buttonId]);
                delete timers[buttonId];
                button.classList.remove('btn-warning', 'timer-running');
                button.classList.add('btn-primary');
                button.innerHTML = '<i class="fas fa-play me-2"></i>Start Bereiding';
                display.textContent = formatTime(totalTime * 60);
            } else {
                // Start timer
                let timeLeft = totalTime * 60;
                button.classList.remove('btn-primary');
                button.classList.add('btn-warning', 'timer-running');
                button.innerHTML = '<i class="fas fa-stop me-2"></i>Stop';
                
                timers[buttonId] = setInterval(() => {
                    timeLeft--;
                    display.textContent = formatTime(timeLeft);
                    
                    if (timeLeft <= 0) {
                        clearInterval(timers[buttonId]);
                        delete timers[buttonId];
                        button.classList.remove('btn-warning', 'timer-running');
                        button.classList.add('btn-success');
                        button.innerHTML = '<i class="fas fa-check me-2"></i>Klaar';
                        button.disabled = true;
                    }
                }, 1000);
            }
        }
        
        function formatTime(seconds) {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }
        
        window.startOrderTimer = startOrderTimer;
    });

    function selectDrink(drink) {
        alert(drink + ' geselecteerd!');
        // Voeg logica toe om de selectie op te slaan of te verwerken
    }

    function scrollDrinks(direction) {
        const container = document.querySelector('.row.flex-nowrap');
        const scrollAmount = container.clientWidth / 2; // Scroll de halve breedte van de container
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else if (direction === 'right') {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
    </script>
</body>
</html>