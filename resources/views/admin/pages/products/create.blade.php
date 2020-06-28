@extends('admin.layouts.app')

@section('title')
    New product
@endsection

@section('content')
    
    <div class="row justify-content-center">
            
        <h1 class="display-4 my-5">Create new product</h1>
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            
            @csrf
            
            <div class="row">
                <div class="form-group col-md-6 col-lg-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Product name" value="{{ old('name') }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" 
                    class="form-control @error('description') is-invalid @enderror" 
                    placeholder="Product description" value="{{ old('description') }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                    <label>Photo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" 
                        name="photo" id="photo">
                        <label class="custom-file-label text-truncate" for="photo">Escolher arquivo</label>
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Create</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $('input#photo').on('input', e => {
            let filename = $(e.target).val()
            filename = filename.replace('C:\\fakepath\\', '')
            $(e.target).next('label.custom-file-label').html(filename)
        })
    </script>
@endpush