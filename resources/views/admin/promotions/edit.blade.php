@extends('admin.layout')

@section('content')
<section class="dashboard-card">
    <h2>Editar promoção</h2>

    <form method="POST" action="{{ route('admin.promotions.update', $promotion) }}" class="auth-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Produto</label>
            <select name="product_id" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $promotion->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" value="{{ old('title', $promotion->title) }}" required>
        </div>

        <div class="form-group">
            <label>Desconto (%)</label>
            <input type="number" step="0.01" name="discount_percent" value="{{ old('discount_percent', $promotion->discount_percent) }}" required>
        </div>

        <div class="form-group">
            <label>Data inicial</label>
            <input type="date" name="start_date" value="{{ old('start_date', $promotion->start_date->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label>Data final</label>
            <input type="date" name="end_date" value="{{ old('end_date', $promotion->end_date->format('Y-m-d')) }}" required>
        </div>

        <label class="checkbox">
            <input type="checkbox" name="is_active" {{ $promotion->is_active ? 'checked' : '' }}>
            <span>Promoção ativa</span>
        </label>

        <button class="btn-primary">Atualizar promoção</button>
    </form>
</section>
@endsection
