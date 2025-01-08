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
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="section-title"><i class="fas fa-glass-cheers me-2"></i>Bar</h1>
        <p>Welkom bij de bar. Hier kun je je favoriete drankjes bestellen.</p>

        <!-- Voltooide Bestellingen -->
        <div class="row mt-4">
            <div class="col-md-12">
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
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 