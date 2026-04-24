@extends('admin.layout')

@section('content')
<section class="dashboard-card">
    <div class="section-header">
        <h2>Promoções</h2>
        <a href="{{ route('admin.promotions.create') }}" class="btn-primary link-button">
            Nova promoção
        </a>
    </div>
</section>

<section class="dashboard-card">
    <table class="table">
        <thead>
            <tr>
                <th>Promoção</th>
                <th>Produto</th>
                <th>Desconto</th>
                <th>Período</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->title }}</td>
                    <td>{{ $promotion->product->name }}</td>
                    <td>{{ $promotion->discount_percent }}%</td>
                    <td>
                        {{ $promotion->start_date->format('d/m/Y') }}
                        até
                        {{ $promotion->end_date->format('d/m/Y') }}
                    </td>
                    <td>
                        <span class="status {{ $promotion->is_active ? 'active' : 'inactive' }}">
                            {{ $promotion->is_active ? 'Ativa' : 'Inativa' }}
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn-small">
                                Editar
                            </a>

                            <form method="POST" action="{{ route('admin.promotions.destroy', $promotion) }}">
                                @csrf
                                @method('DELETE')

                                <button class="btn-small danger" onclick="return confirm('Deseja excluir esta promoção?')">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhuma promoção cadastrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
