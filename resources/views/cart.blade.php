<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="home-page">

<header class="home-header">
    <h1>Seu Carrinho</h1>
    <a href="{{ route('home') }}">Voltar para loja</a>
</header>

<main class="dashboard-container">

    @forelse($items as $item)
        @php
            $subtotal = $item->product->price * $item->quantity;
        @endphp

        <div class="dashboard-card">
            <h2>{{ $item->product->name }}</h2>

            <p>
                Preço: R$ {{ number_format($item->product->price, 2, ',', '.') }}
            </p>

            <p>
                Subtotal: R$ {{ number_format($subtotal, 2, ',', '.') }}
            </p>

            <div style="display: flex; gap: 10px; align-items: center;">
                <form method="POST" action="{{ route('cart.decrease', ['id' => $item->id]) }}">
                    @csrf
                    <button type="submit">-</button>
                </form>

                <strong>{{ $item->quantity }}</strong>

                <form method="POST" action="{{ route('cart.increase', ['id' => $item->id]) }}">
                    @csrf
                    <button type="submit">+</button>
                </form>
            </div>

            <form method="POST" action="{{ route('cart.remove', ['id' => $item->id]) }}" style="margin-top: 15px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-outline">Remover</button>
            </form>
        </div>

    @empty
        <div class="dashboard-card">
            <h2>Carrinho vazio</h2>
            <p>Adicione produtos para continuar.</p>
        </div>
    @endforelse

    <div class="dashboard-card">
        <h2>Total: R$ {{ number_format($total, 2, ',', '.') }}</h2>
    </div>

    <form method="POST" action="{{ route('checkout') }}">
   @csrf
   <button class="btn-primary">Finalizar compra</button>
</form>

</main>

</body>
</html>
