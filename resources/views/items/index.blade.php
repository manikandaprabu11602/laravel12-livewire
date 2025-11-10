@extends('layouts.superadmin')

@section('title', 'Shop')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-primary bg-gradient text-white p-5 rounded-4 shadow">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-3">Premium Products</h1>
                        <p class="lead mb-0 fs-5">Discover our exclusive collection of business solutions and tools</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <div class="bg-white bg-opacity-25 d-inline-flex align-items-center p-3 rounded-3">
                            <i class="fas fa-crown fa-2x text-warning me-3"></i>
                            <div>
                                <h4 class="mb-0">Premium Quality</h4>
                                <small>Trusted by professionals</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 p-3 rounded me-3">
                            <i class="fas fa-box-open fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">{{ count($products) }}</h3>
                            <p class="mb-0 opacity-75">Total Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 bg-success bg-gradient text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 p-3 rounded me-3">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">6</h3>
                            <p class="mb-0 opacity-75">Categories</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 bg-info bg-gradient text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 p-3 rounded me-3">
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">4.9</h3>
                            <p class="mb-0 opacity-75">Average Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100 bg-warning bg-gradient text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 p-3 rounded me-3">
                            <i class="fas fa-bolt fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold">24+</h3>
                            <p class="mb-0 opacity-75">New This Week</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h5 class="card-title mb-3">Filter Products</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-primary active">All Products</button>
                                <button class="btn btn-outline-primary">Software</button>
                                <button class="btn btn-outline-primary">Services</button>
                                <button class="btn btn-outline-primary">Subscriptions</button>
                                <button class="btn btn-outline-primary">Tools</button>
                                <button class="btn btn-outline-primary">Templates</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-0 bg-light" placeholder="Search products...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach($products as $index => $product)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <!-- Product Badge -->
                    @if($index % 4 == 0)
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-danger fs-6">HOT</span>
                        </div>
                    @elseif($index % 3 == 0)
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-success fs-6">NEW</span>
                        </div>
                    @endif

                    <!-- Product Image/Icon -->
                    <div class="card-img-top bg-gradient-light d-flex align-items-center justify-content-center position-relative" style="height: 200px;">
                        <i class="fas fa-{{ $index % 6 == 0 ? 'cube' : ($index % 5 == 0 ? 'chart-line' : ($index % 4 == 0 ? 'database' : ($index % 3 == 0 ? 'cog' : ($index % 2 == 0 ? 'shield-alt' : 'rocket')))) }} text-primary fa-4x"></i>
                        <div class="position-absolute bottom-0 end-0 m-3">
                            <span class="badge bg-primary fs-6">
                                <i class="fas fa-star me-1"></i>4.8
                            </span>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="card-body d-flex flex-column p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
                            <i class="fas fa-bookmark text-muted fs-5"></i>
                        </div>
                        
                        <p class="card-text text-muted flex-grow-1 mb-4">{{ Str::limit($product->description, 120) }}</p>
                        
                        <div class="mt-auto">
                            <!-- Pricing -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="h3 fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                                    @if($product->price > 50)
                                        <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->price * 1.2, 2) }}</span>
                                    @endif
                                </div>
                                @if($product->price > 50)
                                    <span class="badge bg-success fs-6">Save 20%</span>
                                @endif
                            </div>

                            <!-- Features -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small>Instant Delivery</small>
                                </div>
                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small>24/7 Support</small>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small>Free Updates</small>
                                </div>
                            </div>

                            <!-- Buy Button -->
                            <button class="btn btn-primary w-100 py-3 buy-btn fw-bold" data-id="{{ $product->id }}">
                                <i class="fas fa-shopping-cart me-2"></i>Buy Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Call to Action Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-dark text-white">
                <div class="card-body p-5 text-center">
                    <h2 class="display-5 fw-bold mb-3">Need Custom Solutions?</h2>
                    <p class="lead mb-4">Contact our team for tailored business solutions that fit your specific needs</p>
                    <div class="d-flex justify-content-center gap-3">
                        <button class="btn btn-light btn-lg px-4">
                            <i class="fas fa-headset me-2"></i>Contact Sales
                        </button>
                        <button class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-calendar me-2"></i>Schedule Demo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = '{{ csrf_token() }}';
    document.querySelectorAll('.buy-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const originalText = btn.innerHTML;
            
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
                btn.innerHTML = originalText;
            }
        });
    });
});
</script>
@endpush

@endsection