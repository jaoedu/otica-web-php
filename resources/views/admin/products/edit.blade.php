@extends('admin.layout')

@section('content')
<section class="dashboard-card">
    <h2>Editar produto</h2>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="auth-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" value="{{ old('description', $product->description) }}">
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
        </div>

        @if($product->image)
            <div class="form-group">
                <label>Imagem atual</label>
                <img src="{{ asset('storage/' . $product->image) }}" class="admin-thumb">
            </div>
        @endif

        <div class="form-group">
            <label>Nova imagem</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label>Estoque</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <label class="checkbox">
            <input type="checkbox" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
            <span>Produto ativo</span>
        </label>

        <button class="btn-primary">Atualizar produto</button>
    </form>
</section>
@endsection
