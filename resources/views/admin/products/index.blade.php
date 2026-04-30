@extends('admin.layout')

@section('content')

<section class="page-header">

    <div>
        <p class="page-kicker">administração</p>
        <h1>Produtos</h1>
        <span>{{ $products->count() }} produtos cadastrados</span>
    </div>

    <a
        href="{{ route('admin.products.create') }}"
        class="btn-primary"
    >
        + Novo produto
    </a>

</section>


<section class="dashboard-card search-card">

    <form class="search-form">
        <input
            type="text"
            placeholder="Buscar produto..."
        >

        <button type="submit">
            Buscar
        </button>
    </form>

</section>


<section class="dashboard-card table-wrapper">

    <table class="modern-table">

        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Status</th>
                <th class="text-right">Ações</th>
            </tr>
        </thead>

        <tbody>

            @forelse($products as $product)
                <tr>

                    <td>
                        <div class="product-cell">

                            @if($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    class="admin-thumb"
                                >
                            @else
                                <div class="thumb-placeholder">
                                    📦
                                </div>
                            @endif

                            <div>
                                <strong>{{ $product->name }}</strong>
                                <small>ID #{{ $product->id }}</small>
                            </div>

                        </div>
                    </td>

                    <td>
                        <span class="price-tag">
                            R$ {{ number_format($product->price,2,',','.') }}
                        </span>
                    </td>

                    <td>
                        <span class="stock-badge">
                            {{ $product->stock }} un.
                        </span>
                    </td>

                    <td>
                        <span class="status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                            {{ $product->is_active ? 'Ativo' : 'Inativo' }}
                        </span>
                    </td>

                    <td>
                        <div class="table-actions">

                            <a
                                href="{{ route('admin.products.edit', $product) }}"
                                class="btn-action edit"
                            >
                                Editar
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.products.destroy', $product) }}"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn-action delete"
                                    onclick="return confirm('Deseja excluir este produto?')"
                                >
                                    Excluir
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <span>📦</span>
                            <h3>Nenhum produto cadastrado</h3>
                            <p>Comece adicionando seu primeiro produto.</p>
                        </div>
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</section>

@endsection
