<div class="p-4">
    <h2 class="mb-4">{{ $isEditMode ? 'Edit Product' : 'Create Product' }}</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
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
            <button type="submit" class="btn btn-primary">{{ $isEditMode ? 'Update' : 'Save' }}</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to list</a>
            @if($isEditMode)
                <button type="button" wire:click="resetFields" class="btn btn-light">Reset</button>
            @endif
        </div>
    </form>
</div>
