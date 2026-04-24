@extends('admin.layout')

@section('content')
<section class="dashboard-card">
    <h2>Cadastrar produto</h2>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="auth-form">
        @csrf

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <small class="error-text">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" value="{{ old('description') }}">
            @error('description') <small class="error-text">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
            @error('price') <small class="error-text">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="image" accept="image/*">
            @error('image') <small class="error-text">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Estoque</label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}" required>
            @error('stock') <small class="error-text">{{ $message }}</small> @enderror
        </div>

        <label class="checkbox">
            <input type="checkbox" name="is_active" checked>
            <span>Produto ativo</span>
        </label>

        <button class="btn-primary">Salvar produto</button>
    </form>
</section>
@endsection
