@extends('admin.layout')

@section('content')
<section class="dashboard-card">
    <h2>Cadastrar promoção</h2>

    <form method="POST" action="{{ route('admin.promotions.store') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <label>Produto</label>
            <select name="product_id" required>
                <option value="">Selecione um produto</option>

                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label>Desconto (%)</label>
            <input type="number" step="0.01" name="discount_percent" value="{{ old('discount_percent') }}" required>
        </div>

        <div class="form-group">
            <label>Data inicial</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}" required>
        </div>

        <div class="form-group">
            <label>Data final</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}" required>
        </div>

        <label class="checkbox">
            <input type="checkbox" name="is_active" checked>
            <span>Promoção ativa</span>
        </label>

        <button class="btn-primary">Salvar promoção</button>
    </form>
</section>
@endsection
