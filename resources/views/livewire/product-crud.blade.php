<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Product Management</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th><th>Name</th><th>Price</th><th>Qty</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button wire:click="delete({{ $product->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
