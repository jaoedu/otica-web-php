@extends('admin.layout')

@section('content')
   <section class="dashboard-grid">
       <article class="mini-card">
           <h3>Total de produtos</h3>
           <p>{{ $totalProducts }}</p>
       </article>

       <article class="mini-card">
           <h3>Total de promoções</h3>
           <p>{{ $totalPromotions }}</p>
       </article>

       <article class="mini-card">
           <h3>Ações rápidas</h3>
           <p>
               <a href="{{ route('admin.products.create') }}">Cadastrar produto</a><br>
               <a href="{{ route('admin.promotions.create') }}">Cadastrar promoção</a>
           </p>
       </article>
   </section>
@endsection
