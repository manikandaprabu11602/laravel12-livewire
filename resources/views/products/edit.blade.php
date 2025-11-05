@extends('layouts.superadmin')

@section('title', 'Edit Product')

@section('content')
    @php $productId = $id ?? null; @endphp
    @livewire('product-form', ['productId' => $productId])
@endsection
