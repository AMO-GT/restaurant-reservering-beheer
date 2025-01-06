<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling Aanmaken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Bestelling Aanmaken</h2>

    <!-- Formulier voor het toevoegen van een bestelling -->
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Klantnaam</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="items" class="form-label">Bestelde Items</label>
            <textarea name="items" id="items" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Bestelling Plaatsen</button>
    </form>
</div>

</body>
</html>
