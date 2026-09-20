@props(['title', 'breadcrumbs' => []])

<section class="page-banner bg-light-soft py-5 border-bottom">
    <div class="container text-center">
        <h1 class="fw-bold text-dark mb-3">{{ $title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
                
                @foreach($breadcrumbs as $label => $url)
                    @if($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $url }}" class="text-decoration-none">{{ $label }}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</section>

@push('styles')
<style>
    .page-banner {
        background: linear-gradient(to right, rgba(244, 247, 246, 0.9), rgba(244, 247, 246, 0.9)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center/cover no-repeat;
    }
    .breadcrumb-item a {
        color: var(--primary-color);
        font-weight: 500;
    }
    .breadcrumb-item.active {
        color: var(--text-muted);
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\F285"; /* Bootstrap Icon Chevron Right */
        font-family: "bootstrap-icons";
    }
</style>
@endpush
