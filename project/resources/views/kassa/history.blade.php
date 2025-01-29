<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kassa - Geschiedenis</title>
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

        .bon-item {
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bon-item:last-child {
            border-bottom: none;
        }

        .total-price {
            font-size: 1.2em;
            font-weight: bold;
            color: var(--primary);
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
        }

        .price {
            font-weight: 600;
            color: var(--primary);
        }

        .status-badge {
            padding: 0.4em 1em;
            border-radius: 20px;
            font-weight: 500;
            background-color: var(--success);
            color: white;
        }

        .daily-total {
            background-color: var(--primary);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .daily-total h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .daily-total .amount {
            font-size: 2rem;
            font-weight: bold;
            color: var(--light);
        }

        .date-divider {
            font-size: 1.5rem;
            color: var(--primary);
            margin: 2rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--secondary);
        }
    </style>
</head>
<body>
    @include('layouts.nav')
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="section-title mb-0"><i class="fas fa-history me-2"></i>Geschiedenis</h1>
            <a href="{{ route('kassa.index') }}" class="btn btn-primary">
                <i class="fas fa-cash-register me-2"></i>Terug naar Kassa
            </a>
        </div>
        <p class="lead">Overzicht van alle afgerekende bonnen per dag.</p>

        @foreach ($orders as $date => $dayOrders)
            @php
                $dailyTotal = 0;
                foreach ($dayOrders as $order) {
                    $orderTotal = 0;
                    foreach (explode(', ', $order->items) as $item) {
                        $orderTotal += $prices[$item] ?? 0;
                    }
                    $dailyTotal += $orderTotal;
                }
            @endphp

            <div class="daily-total d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-calendar-day me-2"></i>{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h2>
                <div class="text-end">
                    <div class="text-light mb-1">Totale Omzet</div>
                    <div class="amount">€ {{ number_format($dailyTotal, 2) }}</div>
                </div>
            </div>

            <div class="row">
                @foreach ($dayOrders as $order)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-receipt me-2"></i>Bon #{{ $order->id }} - {{ $order->customer_name }}</span>
                                <span class="status-badge">{{ $order->status }}</span>
                            </div>
                            <div class="card-body">
                                <div class="bon-items">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach (explode(', ', $order->items) as $item)
                                        <div class="bon-item">
                                            <span>{{ $item }}</span>
                                            <span class="price">€ {{ number_format($prices[$item] ?? 0, 2) }}</span>
                                        </div>
                                        @php
                                            $total += $prices[$item] ?? 0;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="total-price d-flex justify-content-between">
                                    <span>Totaal:</span>
                                    <span>€ {{ number_format($total, 2) }}</span>
                                </div>
                                <p class="text-muted mt-3 mb-0">
                                    <i class="fas fa-clock me-2"></i>
                                    <small>Aangemaakt: {{ $order->created_at->format('H:i') }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 