@extends('layouts.app')

@section('title', 'Checkout - Ótica Márcia')

@section('content')

<<div class="checkout-page">

    <div class="checkout-container">

        <h1 class="checkout-title">
            Finalizar compra
        </h1>

        <div class="checkout-grid">

            <div class="checkout-form">

                <form method="POST" action="{{ route('checkout.process') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nome completo</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ auth()->user()->name }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" name="cep" required>
                    </div>

                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" name="street" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Número</label>
                            <input type="text" name="number" required>
                        </div>

                        <div class="form-group">
                            <label>Bairro</label>
                            <input type="text" name="district" required>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="btn-primary"
                    >
                        Confirmar pedido
                    </button>

                </form>

            </div>

            <div class="payment-card">

                <h2>Resumo</h2>

                @foreach($items as $item)
                    <div class="summary-row">
                        <span>
                            {{ $item->product->name }}
                            x{{ $item->quantity }}
                        </span>

                        <strong>
                            R$
                            {{ number_format($item->product->price * $item->quantity,2,',','.') }}
                        </strong>
                    </div>
                @endforeach

                <div class="payment-total">
                    R$ {{ number_format($total,2,',','.') }}
                </div>

                <button class="btn-primary">
                    Finalizar compra
                </button>

            </div>

        </div>

    </div>

</div>

@endsection
