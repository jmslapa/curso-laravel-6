@extends('admin.layouts.app')

@section('title')
    Products
@endsection

@section('content')
    <div class="row justify-content-center">
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
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                                <tr>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td class="text-right">R$ {{ str_replace('.', ',', $p->price) }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $p->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
                {{ $products->links() }}
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
