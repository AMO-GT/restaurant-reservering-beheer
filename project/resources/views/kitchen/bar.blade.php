<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar</title>
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

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: white;
            border-bottom: 2px solid var(--secondary);
            border-radius: 10px 10px 0 0 !important;
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid var(--secondary);
            display: inline-block;
        }

        .drinks-category {
            color: var(--primary);
            font-weight: 600;
            margin: 1rem 0;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .form-check {
            padding: 0.5rem;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .form-check:hover {
            background-color: #f8f9fa;
        }

        .form-check-input:checked + .form-check-label {
            color: var(--primary);
            font-weight: 600;
        }

        .status-badge {
            padding: 0.4em 1em;
            border-radius: 20px;
            font-weight: 500;
            background-color: var(--success);
            color: white;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            padding: 0.5rem 1.5rem;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background-color: #34495e;
        }

        .order-items {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    @include('layouts.nav')
    
    <div class="container mt-4">
        <h1 class="section-title"><i class="fas fa-glass-cheers me-2"></i>Bar</h1>
        <p class="lead">Hier kun je dranken toevoegen aan voltooide bestellingen.</p>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show success-message" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Voltooide Bestellingen -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h3 class="section-title">
                    <i class="fas fa-check-circle me-2"></i>Voltooide Bestellingen
                </h3>
                @foreach ($orders as $order)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-receipt me-2"></i>Bestelling #{{ $order->id }} - {{ $order->customer_name }}</span>
                            <span class="status-badge">{{ $order->status }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5><i class="fas fa-utensils me-2"></i>Huidige Bestelling</h5>
                                    <div class="order-items">
                                        <ul class="list-unstyled mb-0">
                                            @foreach (explode(', ', $order->items) as $item)
                                                <li class="d-flex justify-content-between align-items-center mb-2">
                                                    <span><i class="fas fa-check me-2"></i>{{ $item }}</span>
                                                    <form action="{{ route('orders.removeItem', $order->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="item" value="{{ $item }}">
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je dit drankje wilt verwijderen?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <p class="text-muted">
                                        <i class="fas fa-clock me-2"></i>
                                        <small>Aangemaakt: {{ $order->created_at->format('d-m-Y H:i') }}</small>
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <h5><i class="fas fa-plus-circle me-2"></i>Voeg Dranken Toe</h5>
                                    <form action="{{ route('orders.updateItems', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        
                                        @foreach($drinks as $category => $categoryDrinks)
                                            <div class="drinks-category">
                                                <i class="fas fa-glass me-2"></i>{{ $category }}
                                            </div>
                                            <div class="row">
                                                @foreach($categoryDrinks as $drink)
                                                    @if($drink->is_available)
                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" 
                                                                    type="checkbox" 
                                                                    name="drinks[]" 
                                                                    value="{{ $drink->name }}" 
                                                                    id="drink-{{ $drink->id }}-{{ $order->id }}">
                                                                <label class="form-check-label" for="drink-{{ $drink->id }}-{{ $order->id }}">
                                                                    {{ $drink->name }}
                                                                    <small class="text-muted">(€{{ number_format($drink->price, 2) }})</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach

                                        <button type="submit" class="btn btn-primary mt-3">
                                            <i class="fas fa-plus me-2"></i>Voeg Dranken Toe
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('orders.markForPayment', $order->id) }}" method="POST" class="mt-3">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fas fa-cash-register me-2"></i>Afronden en Betalen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Populaire Drankjes -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-star me-2"></i>Populaire Drankjes</h5>
            </div>
            <div class="card-body">
                @if($popularDrinks->count() > 0)
                    <div class="row">
                        @foreach($popularDrinks as $drink)
                            <div class="col-md-4 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ $drink->name }}</span>
                                    <span class="badge bg-primary">{{ $drink->order_count }}x besteld</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">Nog geen populaire drankjes beschikbaar.</p>
                @endif
            </div>
        </div>

        <!-- Drankjes Beheer -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Drankjes Beheer</h5>
            </div>
            <div class="card-body">
                @foreach($drinks as $category => $categoryDrinks)
                    <h6 class="drinks-category">{{ $category }}</h6>
                    <div class="row mb-3">
                        @foreach($categoryDrinks as $drink)
                            <div class="col-md-4 mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ $drink->name }}</span>
                                    <form action="{{ route('drinks.toggleAvailability', $drink->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $drink->is_available ? 'btn-success' : 'btn-danger' }}">
                                            <i class="fas {{ $drink->is_available ? 'fa-check' : 'fa-times' }} me-1"></i>
                                            {{ $drink->is_available ? 'Beschikbaar' : 'Niet Beschikbaar' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Automatisch verbergen van succesmelding na 3 seconden
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                }
            }, 3000);
        });
    </script>
</body>
</html> 