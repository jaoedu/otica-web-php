@extends('admin.layout')

@section('content')
<section class="dashboard-card">
    <div class="section-header">
        <h2>Produtos</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-primary link-button">
            Novo produto
        </a>
    </div>
</section>

<section class="dashboard-card">
    <table class="table">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="admin-thumb">
                        @else
                            <span>Sem imagem</span>
                        @endif
                    </td>

                    <td>{{ $product->name }}</td>

                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>

                    <td>{{ $product->stock }}</td>

                    <td>
                        <span class="status {{ $product->is_active ? 'active' : 'inactive' }}">
                            {{ $product->is_active ? 'Ativo' : 'Inativo' }}
                        </span>
                    </td>

                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-small">
                                Editar
                            </a>

                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                @csrf
                                @method('DELETE')

                                <button class="btn-small danger" onclick="return confirm('Deseja excluir este produto?')">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhum produto cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
