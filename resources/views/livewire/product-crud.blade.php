<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Product Management</h2>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-3">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="mb-4 space-y-3">
        <input type="text" wire:model="name" placeholder="Product Name" class="border rounded p-2 w-full">
        <input type="text" wire:model="price" placeholder="Price" class="border rounded p-2 w-full">
        <input type="number" wire:model="quantity" placeholder="Quantity" class="border rounded p-2 w-full">
        <textarea wire:model="description" placeholder="Description" class="border rounded p-2 w-full"></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $isEditMode ? 'Update' : 'Save' }}
        </button>
        @if ($isEditMode)
            <button type="button" wire:click="resetFields" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        @endif
    </form>

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Price</th>
                <th class="px-4 py-2 border">Qty</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->id }}</td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->price }}</td>
                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <button wire:click="edit({{ $product->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $product->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
