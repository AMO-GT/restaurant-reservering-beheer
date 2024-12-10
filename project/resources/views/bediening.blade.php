<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellingen Opnemen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Bestellingen Opnemen</h1>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div class="mb-3">
                <label for="table_number" class="form-label">Tafelnummer</label>
                <input type="number" name="table_number" id="table_number" class="form-control" required>
            </div>
            <div id="items-container">
                <div class="item mb-3">
                    <label for="item_name" class="form-label">Gerecht</label>
                    <input type="text" name="items[0][name]" class="form-control mb-2" placeholder="Naam van gerecht" required>
                    <label for="quantity" class="form-label">Aantal</label>
                    <input type="number" name="items[0][quantity]" class="form-control" min="1" required>
                </div>
            </div>
            <button type="button" id="add-item" class="btn btn-secondary">Nog een gerecht toevoegen</button>
            <button type="submit" class="btn btn-primary mt-3">Bestelling Opslaan</button>
        </form>
    </div>
    <script>
        let itemCount = 1;
        document.getElementById('add-item').addEventListener('click', () => {
            const container = document.getElementById('items-container');
            const newItem = `
                <div class="item mb-3">
                    <label for="item_name" class="form-label">Gerecht</label>
                    <input type="text" name="items[${itemCount}][name]" class="form-control mb-2" placeholder="Naam van gerecht" required>
                    <label for="quantity" class="form-label">Aantal</label>
                    <input type="number" name="items[${itemCount}][quantity]" class="form-control" min="1" required>
                </div>`;
            container.insertAdjacentHTML('beforeend', newItem);
            itemCount++;
        });
    </script>
</body>

</html>