@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')

<div class="cart-page">
    <div class="cart-container">

        <h1 class="cart-title">
            Seu Carrinho
        </h1>

        <div class="cart-grid">

            <div class="cart-card">

                @forelse($items as $item)
                    @php
                        $subtotal = $item->product->price * $item->quantity;
                    @endphp

                    <div class="cart-item">

                        @if($item->product->image)
                            <img
                                src="{{ asset('storage/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}"
                            >
                        @endif

                        <div>
                            <h3>{{ $item->product->name }}</h3>

                            <p>
                                Preço:
                                R$ {{ number_format($item->product->price, 2, ',', '.') }}
                            </p>

                            <div class="quantity-box">

                                {{-- diminuir --}}
                                <form
                                    method="POST"
                                    action="{{ route('cart.decrease', $item->id) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="qty-btn"
                                    >
                                        -
                                    </button>
                                </form>

                                <span>
                                    {{ $item->quantity }}
                                </span>

                                {{-- aumentar --}}
                                <form
                                    method="POST"
                                    action="{{ route('cart.increase', $item->id) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="qty-btn"
                                    >
                                        +
                                    </button>
                                </form>

                            </div>

                            {{-- remover --}}
                            <form
                                method="POST"
                                action="{{ route('cart.remove', $item->id) }}"
                                style="margin-top:14px;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-small danger"
                                >
                                    Remover
                                </button>
                            </form>

                        </div>

                        <div class="item-price">
                            R$ {{ number_format($subtotal, 2, ',', '.') }}
                        </div>

                    </div>

                @empty
                    <p>Seu carrinho está vazio.</p>
                @endforelse

            </div>

            <div class="cart-summary">

                <h2>Resumo</h2>

                <div class="summary-row">
                    <span>Itens</span>
                    <strong>{{ $items->count() }}</strong>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <strong>
                        R$ {{ number_format($total, 2, ',', '.') }}
                    </strong>
                </div>

                <a
                    href="{{ route('checkout') }}"
                    class="btn-primary"
                    style="display:block;text-align:center;"
                >
                    Finalizar compra
                </a>

            </div>

        </div>

    </div>
</div>

@endsection
