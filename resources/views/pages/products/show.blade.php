@extends('layout.layout')

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{ $item->title }}</h1>
                <p class="lead text-body-secondary">{{ $item->shortDesc }}</p>
            </div>
        </div>
    </section>

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                {!! $item->description !!}
            </div>
        </div>
    </div>
@endsection
