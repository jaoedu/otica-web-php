<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ótica Web</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="home-page">

<header class="home-header">
    <div class="logo">Ótica Web</div>

    <form class="search-bar">
        <input type="text" placeholder="Buscar produtos...">
        <button type="submit">Buscar</button>
    </form>

    <div class="header-actions">
        <span>Olá, {{ auth()->user()->name }}</span>

        <!-- LINK CORRETO DO CARRINHO -->
        <a href="{{ route('cart.index') }}">Carrinho</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </div>
</header>

<main class="home-container">

    <!-- FEEDBACK -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="home-banner">
        <h1>Promoções da semana</h1>
        <p>Óculos, armações e acessórios com preços especiais.</p>
    </section>

    <section class="home-section">
        <h2>Produtos</h2>

        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">

                    <!-- IMAGEM -->
                    @if($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="product-image"
                        >
                    @endif

                    <!-- NOME -->
                    <h3>{{ $product->name }}</h3>

                    <!-- PREÇO -->
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

                    <!-- BOTÃO CORRETO (POST) -->
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button type="submit">Adicionar ao carrinho</button>
                    </form>

                </div>
            @endforeach
        </div>
    </section>

</main>

</body>
</html>
