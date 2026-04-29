@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')

<main class="profile-page">

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <section class="profile-hero">
        <div class="profile-avatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div>
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->email }}</p>
            <span>Cliente desde {{ $user->created_at->format('d/m/Y') }}</span>
        </div>
    </section>

    <section class="profile-grid">

        <div class="profile-card">
            <h2>Meus dados</h2>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <label>Nome</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}">

                <label>Telefone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">

                <label>CPF</label>
                <input type="text" name="cpf" value="{{ old('cpf', $user->cpf) }}">

                <label>Data de nascimento</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}">

                <button type="submit">Salvar dados</button>
            </form>
        </div>

        <div class="profile-card">
            <h2>Endereços</h2>

            @forelse($user->addresses as $address)
                <div class="profile-list-item">
                    <strong>{{ $address->label }}</strong>

                    @if($address->is_default)
                        <span class="badge">Principal</span>
                    @endif

                    <p>
                        {{ $address->street }}, {{ $address->number }}
                        <br>
                        {{ $address->neighborhood }} -
                        {{ $address->city }}/{{ $address->state }}
                        <br>
                        CEP: {{ $address->zip_code }}
                    </p>

                    <form method="POST" action="{{ route('addresses.destroy', $address) }}">
                        @csrf
                        @method('DELETE')

                        <button class="btn-danger" type="submit">
                            Remover
                        </button>
                    </form>
                </div>
            @empty
                <p>Nenhum endereço cadastrado.</p>
            @endforelse

            <form method="POST" action="{{ route('addresses.store') }}" class="profile-form-divider">
                @csrf

                <h3>Novo endereço</h3>

                <input type="text" name="label" placeholder="Casa, Trabalho..." required>
                <input type="text" name="zip_code" placeholder="CEP" required>
                <input type="text" name="street" placeholder="Rua" required>
                <input type="text" name="number" placeholder="Número" required>
                <input type="text" name="complement" placeholder="Complemento">
                <input type="text" name="neighborhood" placeholder="Bairro" required>
                <input type="text" name="city" placeholder="Cidade" required>
                <input type="text" name="state" placeholder="UF" maxlength="2" required>

                <label class="checkbox-line">
                    <input type="checkbox" name="is_default" value="1">
                    Definir como principal
                </label>

                <button type="submit">Cadastrar endereço</button>
            </form>
        </div>

        <div class="profile-card">
            <h2>Minha visão</h2>

            <form method="POST" action="{{ route('vision-profile.update') }}">
                @csrf
                @method('PUT')

                <label class="checkbox-line">
                    <input
                        type="checkbox"
                        name="uses_glasses"
                        value="1"
                        @checked(optional($user->visionProfile)->uses_glasses)
                    >
                    Uso óculos
                </label>

                <label>Tipo de lente preferida</label>
                <input
                    type="text"
                    name="lens_type"
                    placeholder="Antirreflexo, blue light..."
                    value="{{ old('lens_type', optional($user->visionProfile)->lens_type) }}"
                >

                <label>Condição visual</label>
                <input
                    type="text"
                    name="condition"
                    placeholder="Miopia, astigmatismo..."
                    value="{{ old('condition', optional($user->visionProfile)->condition) }}"
                >

                <label class="checkbox-line">
                    <input
                        type="checkbox"
                        name="light_sensitivity"
                        value="1"
                        @checked(optional($user->visionProfile)->light_sensitivity)
                    >
                    Tenho sensibilidade à luz
                </label>

                <label>Observações</label>
                <textarea name="observations" rows="4">{{ old('observations', optional($user->visionProfile)->observations) }}</textarea>

                <button type="submit">Salvar perfil visual</button>
            </form>
        </div>

        <div class="profile-card">
            <h2>Pedidos recentes</h2>

            @forelse($user->orders->take(5) as $order)
                <div class="profile-list-item">
                    <strong>Pedido #{{ $order->id }}</strong>
                    <p>Total: R$ {{ number_format($order->total, 2, ',', '.') }}</p>
                    <p>Data: {{ $order->created_at->format('d/m/Y') }}</p>
                </div>
            @empty
                <p>Você ainda não realizou pedidos.</p>
            @endforelse
        </div>

        <div class="profile-card profile-card-full">
            <h2>Wishlist</h2>

            <div class="wishlist-grid">
                @forelse($user->wishlist as $product)
                    <div class="wishlist-card">
                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                            >
                        @endif

                        <h3>{{ $product->name }}</h3>

                        <p>
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>

                        <form method="POST" action="{{ route('wishlist.destroy', $product) }}">
                            @csrf
                            @method('DELETE')

                            <button class="btn-danger" type="submit">
                                Remover da wishlist
                            </button>
                        </form>
                    </div>
                @empty
                    <p>Nenhum produto salvo na wishlist.</p>
                @endforelse
            </div>
        </div>

    </section>

</main>

@endsection
