@extends('admin.layouts.app')

@section('title')
    New product
@endsection

@section('content')
    <div class="row h-100 flex-column justify-content-center align-items-center">
        <div class="row">
            @include('admin.includes.card-product', [
            'image' => $product->image ? url("/storage/$product->image") : url("/storage/product.default.jpeg"),
            'name' => $product->name,
            'description' => $product->description,
            'price' => number_format($product->price, 2, ',', ''),
            'created' => $product->created_at,
            'updated' => $product->updated_at
            ])
        </div>        
        <div class="mt-4" aria-label="Action Buttons">
            <a href="{{ route('products.index') }}" class="btn btn-lg btn-secondary">Home</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-lg btn-primary">Edit</a>
            <form method="post" class="d-inline" 
            action="{{ route('products.destroy', $product->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-lg btn-danger">Delete</button>
            </form>
        </div>
    </div>
    
@endsection