@props(['links'])

<nav aria-label="breadcrumb" class="mb-3 mb-md-4">
    <ol class="breadcrumb small text-uppercase m-0" style="letter-spacing: 0.05rem;">
        @foreach($links as $label => $url)
            @if($loop->last)
                <li class="breadcrumb-item active text-graphite fw-bold" aria-current="page">{{ $label }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $url }}" class="text-muted-gray text-decoration-none">{{ $label }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
