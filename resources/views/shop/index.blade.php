@extends('layouts.superadmin')

@section('title', 'Shop')

@section('content')
<div class="container-lg px-4 py-4">
    <h1 class="mb-4">Shop</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 120) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <div class="fw-bold">${{ number_format($product->price, 2) }}</div>
                            <button class="btn btn-success buy-btn" data-id="{{ $product->id }}">Buy</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = '{{ csrf_token() }}';
    document.querySelectorAll('.buy-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            btn.disabled = true;
            btn.innerText = 'Redirecting...';
            try {
                const res = await fetch('{{ route('stripe.checkout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ product_id: id })
                });
                const data = await res.json();
                if (data.url) {
                    window.location = data.url;
                    return;
                }
                alert('Could not create checkout session.');
                console.error(data);
            } catch (err) {
                console.error(err);
                alert('Network error while creating checkout session');
            } finally {
                btn.disabled = false;
                btn.innerText = 'Buy';
            }
        });
    });
});
</script>
@endpush

@endsection
