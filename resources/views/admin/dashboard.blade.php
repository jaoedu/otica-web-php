@extends('admin.layout')

@section('content')

<section class="dashboard-wrapper">

    {{-- KPIs --}}
    <section class="dashboard-grid">

        <article class="mini-card products">
            <span class="card-icon">📦</span>

            <div class="card-content">
                <h3>Total de produtos</h3>
                <p class="big-number">{{ $totalProducts }}</p>
                <small>Produtos cadastrados</small>
            </div>
        </article>

        <article class="mini-card promotions">
            <span class="card-icon">🏷️</span>

            <div class="card-content">
                <h3>Total de promoções</h3>
                <p class="big-number">{{ $totalPromotions }}</p>
                <small>Promoções ativas</small>
            </div>
        </article>

        <article class="mini-card revenue">
            <span class="card-icon">💰</span>

            <div class="card-content">
                <h3>Receita do mês</h3>
                <p class="big-number">
                    R$ {{ number_format($monthRevenue, 2, ',', '.') }}
                </p>
                <small>Faturamento mensal</small>
            </div>
        </article>

        <article class="mini-card sold">
            <span class="card-icon">🛒</span>

            <div class="card-content">
                <h3>Itens vendidos</h3>
                <p class="big-number">{{ $totalSold }}</p>
                <small>Total comercializado</small>
            </div>
        </article>

    </section>


    {{-- gráfico --}}
    <section class="chart-card">
        <div class="section-title">
            <h2>Vendas dos últimos 7 dias</h2>
            <small>Desempenho recente</small>
        </div>

        <div class="chart-bars">

            @forelse($salesChart as $sale)
                <div class="bar-item">

                    <div
                        class="bar"
                        style="height: {{ max(($sale->total / 50), 20) }}px"
                    ></div>

                    <small>
                        {{ \Carbon\Carbon::parse($sale->date)->format('d/m') }}
                    </small>

                </div>
            @empty
                <p>Nenhuma venda registrada.</p>
            @endforelse

        </div>
    </section>


    {{-- tabelas --}}
    <section class="bottom-grid">

        <article class="table-card">
            <div class="section-title">
                <h2>Últimos pedidos</h2>
                <small>Pedidos recentes</small>
            </div>

            @forelse($latestOrders as $order)

                <div class="list-row">
                    <div>
                        <strong>#{{ $order->id }}</strong>
                        <small>{{ $order->user->name }}</small>
                    </div>

                    <span class="price">
                        R$ {{ number_format($order->total, 2, ',', '.') }}
                    </span>
                </div>

            @empty
                <p class="empty-text">Nenhum pedido encontrado.</p>
            @endforelse
        </article>


        <article class="table-card">
            <div class="section-title">
                <h2>Produtos mais vendidos</h2>
                <small>Ranking atual</small>
            </div>

            @forelse($topProducts as $item)

                <div class="list-row">
                    <strong>{{ $item->product->name }}</strong>

                    <span class="badge">
                        {{ $item->total }} vendas
                    </span>
                </div>

            @empty
                <p class="empty-text">Sem vendas ainda.</p>
            @endforelse
        </article>

    </section>


    {{-- ações rápidas --}}
    <section class="quick-actions-card">

        <div class="section-title">
            <h2>Ações rápidas</h2>
            <small>Gerenciamento rápido</small>
        </div>

        <div class="quick-actions-grid">

            <a href="{{ route('admin.products.create') }}" class="action-btn">
                + Novo produto
            </a>

            <a href="{{ route('admin.promotions.create') }}" class="action-btn">
                + Nova promoção
            </a>

        </div>

    </section>

</section>

@endsection
