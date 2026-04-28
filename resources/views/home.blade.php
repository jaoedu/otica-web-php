@extends('layouts.app')

@section('title', 'Ótica Márcia')

@section('content')

<body class="home-page">



<main class="home-container">

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <section class="home-banner">
        <h1>Promoções da semana</h1>
        <p>
            Óculos, armações e acessórios com preços especiais.
        </p>
    </section>

    <section class="home-section">
        <h2>Produtos</h2>

        <div class="product-grid">

            @foreach($products as $product)
                <div class="product-card">

                    @if($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="product-image"
                        >
                    @endif

                    <h3>{{ $product->name }}</h3>

                    @if($product->activePromotion)

                        <p class="old-price">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>

                        <p class="promo-price">
                            R$ {{ number_format($product->final_price, 2, ',', '.') }}
                        </p>

                    @else

                        <p class="price">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>

                    @endif

                    <form
                        method="POST"
                        action="{{ route('cart.add', $product->id) }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="btn-primary"
                        >
                            Adicionar ao carrinho
                        </button>
                    </form>

                </div>
            @endforeach

        </div>
    </section>

</main>

@endsection
