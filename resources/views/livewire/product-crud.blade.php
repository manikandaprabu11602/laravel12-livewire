<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Product Management</h2>
        @if(!$showForm)
            <button wire:click="showCreateForm" class="btn btn-primary">Create Product</button>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- Product Form --}}
    @if($showForm)
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $editingProductId ? 'Edit Product' : 'Create Product' }}</h5>
            <button wire:click="hideForm" class="btn btn-close"></button>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $editingProductId ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" wire:model="name" class="form-control">
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" wire:model="price" class="form-control">
                    @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" wire:model="quantity" class="form-control">
                    @error('quantity') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea wire:model="description" class="form-control"></textarea>
                    @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ $editingProductId ? 'Update' : 'Save' }}</button>
                    <button type="button" wire:click="hideForm" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @else
    {{-- Product List --}}
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
                        <button wire:click="showEditForm({{ $product->id }})" class="btn btn-warning btn-sm">Edit</button>
                        <button wire:click="delete({{ $product->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
