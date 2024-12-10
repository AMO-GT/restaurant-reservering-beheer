<!-- resources/views/kitchen/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuken Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Keuken Dashboard</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Bestelling ID</th>
                    <th>Tafelnummer</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->table_number }}</td>
                        <td>{{ $order->order_details }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <form action="{{ route('order.update.status', $order->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>In behandeling</option>
                                    <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>In voorbereiding</option>
                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Klaar</option>
                                    <option value="served" {{ $order->status == 'served' ? 'selected' : '' }}>Geserveerd</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
