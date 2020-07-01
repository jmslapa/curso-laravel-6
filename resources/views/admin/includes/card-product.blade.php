
<div class="border rounded bg-white row">
    <div class="m-3">
        <img class="" src="{{ $image ?? '' }}" alt="Product Photo" width="200">
    </div>  
    <div class="d-flex flex-column justify-content-center m-3">                  
        <h1 class="">{{ $name ?? 'Product' }}</h1>
        <p class="font-weight-light">{{ $description ?? 'This is a standard product description. It is being shown,
        because the product does not have an official description.' }}</p>
        <h5 class="font-weight-bolder">R$ {{ $price ?? '0000,00' }} </h5>
        <h6 class=""><strong>Created: </strong>{{ $created ?? now() }}</h6>
        <h6 class=""><strong>Updated: </strong>{{ $updated ?? now() }}</h6>
    </div>
</div>