@extends('admin.layouts.app')

@section('title')
    New product
@endsection

@section('content')
    
    <div class="row h-100 justify-content-center align-items-center">
            
        <h1 class="display-4 my-5">Create new product</h1>
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            
            @include('admin.pages.products._partials.form')

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Create</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $('input#image').on('input', e => {
            let filename = $(e.target).val()
            filename = filename.replace('C:\\fakepath\\', '')
            $(e.target).next('label.custom-file-label').html(filename)
        })
    </script>
@endpush