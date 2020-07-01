@extends('admin.layouts.app')

@section('title')
    Products
@endsection

@section('content')
    <div class="row h-100 justify-content-center align-items-center">
        <form class="form-inline mr-auto" method="post" action="{{ route('products.search') }}">
            @csrf
            <div class="input-group">
                <input type="text" name="filter" class="form-control" 
                placeholder="Search..." value="{{ $filters['filter'] ?? '' }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-success">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <h1 class="display-4 my-5">List of products</h1>
        @isset($products)
            @empty($products)
                @include('admin.includes.alert', [
                    'type' => 'danger',
                    'message' => 'There are no products',
                    'link' => 'Create a new one.',
                    'href' => route('products.create')
                ])
            @else
                <div class="table-responsive">               
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                                <tr>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td class="text-right">R$ {{ number_format($p->price, 2, ',', '') }}</td>
                                    <td>
                                        <a class="text-info text-decoration-none" 
                                        href="{{ route('products.show', $p->id) }}">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <a class="text-secondary text-decoration-none" 
                                        href="{{ route('products.edit', $p->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="post" class="d-inline" 
                                        action="{{ route('products.destroy', $p->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger p-0">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
                @isset($filters)
                    {{ $products->appends($filters)->links() }}
                @else
                    {{ $products->links() }}
                @endisset
            @endempty
        @else
            @include('admin.includes.alert', [
                'type' => 'danger',
                'message' => 'The products could not be consulted.',
                'link' => 'Report this.'
            ])
        @endisset
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg btn-block my-3">Create New</a>    
    </div>
@endsection
