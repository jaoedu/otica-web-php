@extends('layouts.app')

@section('title', 'Meus Pedidos')

@section('content')

<div class="orders-page">

    <div class="orders-container">

        <h1 class="orders-title">
            Meus pedidos
        </h1>

        <p class="orders-subtitle">
            acompanhe o histórico das suas compras
        </p>
        @forelse($orders as $order)

            <div class="order-card">

                <div class="order-header">

                    <div>
                        <div class="order-number">
                            Pedido #{{ $order->id }}
                        </div>

                        <div class="order-date">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div>
                        <div class="order-total">
                            R$ {{ number_format($order->total, 2, ',', '.') }}
                        </div>

                        <span class="order-status delivered">
                            Finalizado
                        </span>
                    </div>

                </div>

                <div class="order-body">

                    @foreach($order->items as $item)

                        <div class="order-item">

                            @if($item->product->image)
                                <img
                                    src="{{ asset('storage/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                >
                            @endif

                            <div>
                                <h4>
                                    {{ $item->product->name }}
                                </h4>

                                <p>
                                    Quantidade: {{ $item->quantity }}
                                </p>
                            </div>

                            <div class="order-price">
                                R$
                                {{ number_format($item->price, 2, ',', '.') }}
                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @empty

            <div class="order-card">
                <div class="order-body">
                    Você ainda não realizou compras.
                </div>
            </div>

        @endforelse

    </div>

</div>

@endsection
