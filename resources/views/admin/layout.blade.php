<!DOCTYPE html>
<html lang="pt-BR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Ótica</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dashboard-page">

   <header class="topbar">
       <div>
           <span class="brand-badge">
               Admin Ótica
           </span>

           <h1 class="dashboard-title">
               Painel Administrativo
           </h1>
       </div>

       <div class="topbar-actions">
           <a
               href="{{ route('admin.dashboard') }}"
               class="btn-outline"
           >
               Dashboard
           </a>

           <a
               href="{{ route('admin.products.index') }}"
               class="btn-outline"
           >
               Produtos
           </a>

           <a
               href="{{ route('admin.promotions.index') }}"
               class="btn-outline"
           >
               Promoções
           </a>

           <form method="POST" action="{{ route('logout') }}">
               @csrf

               <button
                   type="submit"
                   class="btn-outline"
               >
                   Sair
               </button>
           </form>
       </div>
   </header>

   <main class="dashboard-container">

       @if(session('success'))
           <div class="alert success">
               {{ session('success') }}
           </div>
       @endif

       @yield('content')

   </main>



</body>
</html>
