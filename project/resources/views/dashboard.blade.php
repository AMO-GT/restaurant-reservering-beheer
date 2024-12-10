<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bestellingen Opnemen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Bestellingen Opnemen</h1>
                    @if(session('success'))
                        <div class="alert alert-success mb-4 p-4 rounded bg-green-200 text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="table_number" class="block font-medium text-sm text-gray-700">Tafelnummer</label>
                            <input type="number" name="table_number" id="table_number" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div id="items-container">
                            <div class="item mb-4">
                                <label for="item_name" class="block font-medium text-sm text-gray-700">Gerecht</label>
                                <input type="text" name="items[0][name]" class="form-input rounded-md shadow-sm mt-1 block w-full mb-2" placeholder="Naam van gerecht" required>
                                <label for="quantity" class="block font-medium text-sm text-gray-700">Aantal</label>
                                <input type="number" name="items[0][quantity]" class="form-input rounded-md shadow-sm mt-1 block w-full" min="1" required>
                            </div>
                        </div>
                        <button type="button" id="add-item" class="mt-2 px-4 py-2 bg-gray-500 text-white rounded shadow">
                            Nog een gerecht toevoegen
                        </button>
                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded shadow">
                            Bestelling Opslaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let itemCount = 1;
        document.getElementById('add-item').addEventListener('click', () => {
            const container = document.getElementById('items-container');
            const newItem = `
                <div class="item mb-4">
                    <label for="item_name" class="block font-medium text-sm text-gray-700">Gerecht</label>
                    <input type="text" name="items[${itemCount}][name]" class="form-input rounded-md shadow-sm mt-1 block w-full mb-2" placeholder="Naam van gerecht" required>
                    <label for="quantity" class="block font-medium text-sm text-gray-700">Aantal</label>
                    <input type="number" name="items[${itemCount}][quantity]" class="form-input rounded-md shadow-sm mt-1 block w-full" min="1" required>
                </div>`;
            container.insertAdjacentHTML('beforeend', newItem);
            itemCount++;
        });
    </script>
</x-app-layout>
