@extends('layouts.superadmin')

@section('title', 'Shop')

@section('content')
<body class="bg-light">
    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-primary bg-gradient text-white p-4 rounded-3 shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-5 fw-bold mb-2">Product Shop</h1>
                            <p class="lead mb-0">Browse and purchase premium products for your business needs</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="bg-white bg-opacity-25 d-inline-block p-3 rounded-3">
                                <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Ready to Buy</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats and Filters Section -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-boxes text-primary fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">{{ count($products) }}</h5>
                                <p class="text-muted mb-0">Total Products</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                <i class="fas fa-tags text-success fs-4"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">5</h5>
                                <p class="text-muted mb-0">Categories</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Filter Products</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-outline-primary active">All Products</button>
                            <button class="btn btn-outline-primary">Software</button>
                            <button class="btn btn-outline-primary">Services</button>
                            <button class="btn btn-outline-primary">Subscriptions</button>
                            <button class="btn btn-outline-primary">Tools</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-cube text-muted display-4"></i>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <span class="badge bg-primary">Popular</span>
                            </div>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($product->description, 120) }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <span class="h4 text-primary fw-bold">${{ number_format($product->price, 2) }}</span>
                                        <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->price * 1.2, 2) }}</span>
                                    </div>
                                    <span class="badge bg-success">Save 20%</span>
                                </div>
                                <button class="btn btn-primary w-100 buy-btn" data-id="{{ $product->id }}">
                                    <i class="fas fa-shopping-cart me-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Featured Product Banner -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="text-warning"><i class="fas fa-star me-2"></i>Featured Product</h3>
                                <h4 class="card-title">Premium Business Suite</h4>
                                <p class="card-text">Get all our premium products in one bundle at a special discounted price.</p>
                                <button class="btn btn-warning btn-lg">
                                    <i class="fas fa-gem me-2"></i>View Bundle Offer
                                </button>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="bg-warning bg-opacity-25 p-4 rounded-3 d-inline-block">
                                    <h2 class="text-warning mb-0">$299.99</h2>
                                    <p class="mb-0">Limited Time Offer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = '{{ csrf_token() }}';
        document.querySelectorAll('.buy-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
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
                    btn.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Buy Now';
                }
            });
        });
    });
</script>


@endsection