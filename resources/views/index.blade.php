@extends('layout.layout')

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-body-secondary">Something short and leading about the collection below—its
                    contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply
                    skip over it entirely.</p>
                <p><a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary
                        action</a>
                </p>
            </div>
        </div>
    </section>

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                @if(count($products))
                    <h2 class="fw-light text-center mb-4">Товары</h2>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
                        @foreach($products as $product)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <img src="{{ $product->getImage() }}" alt="">
                                    <div class="card-body">
                                        <h5>{{ $product->title }}</h5>
                                        <p class="card-text">{!! $product->shortDesc !!}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('products.show', ['id' => $product->id]) }}"
                                                   type="button" class="btn btn-sm btn-outline-secondary">View</a>
                                            </div>
                                            <small
                                                class="text-body-secondary">{{ \Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(count($pages))
                    <h2 class="fw-light text-center mb-4">Страницы</h2>
                    <div class="row mb-2">
                        @foreach($pages as $page)
                            <div class="col-md-6">
                            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col p-4 d-flex flex-column position-static"><strong
                                    <h3 class="mb-0">{{ $page->title }}</h3>
                                    <div class="mb-1 text-body-secondary">{{ \Carbon\Carbon::parse($page->created_at)->format('d-m-Y') }}</div>
                                    <p class="card-text mb-auto">{{ $page->shortDesc }}</p>
                                    <a href=" {{ route('pages.show', ['id' => $product->id]) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                                        Continue reading
                                        <svg class="bi" aria-hidden="true">
                                            <use xlink:href="#chevron-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
