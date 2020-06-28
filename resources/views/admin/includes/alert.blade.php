<div class="alert alert-dismissible fade show alert-{{ $type ?? 'success' }}" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{ $message }} <a href="{{ $href ?? '#' }}" class="alert-link">{{ $link ?? '' }}</a>
</div>