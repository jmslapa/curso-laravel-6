@extends('admin.layouts.app')

@section('title')
    Edit product
@endsection

@section('content')
    
    <div class="row h-100 justify-content-center align-items-center">        
            <div class="text-center my-5">
                @if (isset($product) && !is_null($product->image))
                    <img src="{{ url("/storage/$product->image") }}" alt="Product image" width="250"
                    class="img-fluid rounded shadow">
                @else
                    <img src="{{ url("/storage/product.default.jpeg") }}" alt="Product default image" width="250"
                    class="img-fluid rounded shadow">
                @endif
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                
                @method('PUT')
                
                @include('admin.pages.products._partials.form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                </div>
            </form>
    </div>
@endsection   

@push('script')
    <script>
        $('input#image').on('input', e => {
            let filename = $(e.target).val()
            if(filename != '') {
                filename = filename.replace('C:\\fakepath\\', '')
                $(e.target).next('label.custom-file-label').html(filename)
            }else {
                $(e.target).next('label.custom-file-label').html('New product image')
            }
        })
        $('#removeImage').on('click', e => {
            if($(e.target).prop('checked')) {
                $('input#image').attr('disabled','disabled').val('').trigger('input')
                
            }else {
                $('input#image').removeAttr('disabled')
            }                       
        })
    </script>
@endpush