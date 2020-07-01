@csrf
<div class="row">
    <div class="form-group col-lg-6">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Product name" 
        class="form-control @error('name') is-invalid @enderror" 
        placeholder="Product name" value="{{ $product->name ?? old('name') }}">
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>Image</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
            name="image" id="image">
            <label class="custom-file-label text-truncate" for="image">New product image</label>
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            @if (isset($product) && !is_null($product->image))
                @include('admin.pages.products._partials.checkbox')
            @endif
        </div>
    </div>
    <div class="form-group col-md-6 col-lg-4">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" placeholder="Product price (Ex: 100,00)"
        class="form-control text-right @error('price') is-invalid @enderror" 
        placeholder="Product price" 
        value="{{ number_format($product->price ?? (double)old('price'), 2, ',', '') }}">
        <div class="invalid-feedback">
            {{ $errors->first('price') }}
        </div>
    </div>                
    <div class="form-group col">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" placeholder="Product description"
        class="form-control @error('description') is-invalid @enderror" 
        placeholder="Product description" value="{{ $product->description ?? old('description') }}">
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    </div>
</div>