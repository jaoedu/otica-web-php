@foreach($orders as $order)
   <div class="dashboard-card">
       <h2>Pedido #{{ $order->id }}</h2>
       <p>Total: R$ {{ number_format($order->total, 2, ',', '.') }}</p>

       @foreach($order->items as $item)
           <p>{{ $item->product->name }} ({{ $item->quantity }})</p>
       @endforeach
   </div>
@endforeach
