@extends('layouts.app')

@section('title', 'Ótica Márcia')

@section('content')

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

    @if($promotions->isEmpty() && $products->isEmpty())
        <div class="empty-state">
            Nenhum produto encontrado.
        </div>
    @endif

    @if($promotions->count())
        <section class="home-section">
            <h2>Promoções</h2>

            <div class="product-grid">

                @foreach($promotions as $product)
                    <div class="product-card promo-card">

                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="product-image"
                            >
                        @endif

                        <h3>{{ $product->name }}</h3>

                        <p class="old-price">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>

                        <p class="promo-price">
                            R$ {{ number_format($product->final_price, 2, ',', '.') }}
                        </p>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf

                            <button type="submit" class="btn-primary">
                                Adicionar ao carrinho
                            </button>
                        </form>

                        <form method="POST" action="{{ route('wishlist.toggle', $product->id) }}">
                            @csrf

                            <button type="submit" class="wishlist-button">
                                ❤️ Salvar
                            </button>
                        </form>

                    </div>
                @endforeach

            </div>
        </section>
    @endif

    @if($products->count())
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

                        <p class="price">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf

                            <button type="submit" class="btn-primary">
                                Adicionar ao carrinho
                            </button>
                        </form>

                        <form method="POST" action="{{ route('wishlist.toggle', $product->id) }}">
                            @csrf

                            <button type="submit" class="wishlist-button">
                                ❤️ Salvar
                            </button>
                        </form>

                    </div>
                @endforeach

            </div>
        </section>
    @endif

</main>

@endsection
