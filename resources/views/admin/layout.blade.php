<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin | Ótica Márcia</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="dashboard-page">

<header class="topbar">

    <div class="topbar-left">

        <div class="brand-box">
            👓
        </div>

        <div>
            <span class="brand-badge">
                ÓTICA MÁRCIA • ADMIN
            </span>

            <h1 class="dashboard-title">
                Painel Administrativo
            </h1>
        </div>

    </div>


    <nav class="topbar-nav">

        <a
            href="{{ route('admin.dashboard') }}"
            class="nav-link"
        >
            Dashboard
        </a>

        <a
            href="{{ route('admin.products.index') }}"
            class="nav-link"
        >
            Produtos
        </a>

        <a
            href="{{ route('admin.promotions.index') }}"
            class="nav-link"
        >
            Promoções
        </a>

    </nav>


    <div class="topbar-right">

        <div class="user-pill">
            <span class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </span>

            <div>
                <small>Administrador</small>
                <strong>{{ auth()->user()->name }}</strong>
            </div>
        </div>

        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf

            <button
                type="submit"
                class="logout-btn"
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
