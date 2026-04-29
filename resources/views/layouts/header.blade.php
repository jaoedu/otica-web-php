<header class="site-header">

    <div class="header-container">

        <a
            href="{{ route('home') }}"
            class="site-logo"
        >
            Ótica Márcia
        </a>

        <form
            method="GET"
            action="{{ route('home') }}"
            class="site-search"
        >
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar produtos..."
            >

            <button type="submit">
                Buscar
            </button>
        </form>

        <nav class="site-nav">

            <a href="{{ route('home') }}">
                Home
            </a>

            <a href="{{ route('cart.index') }}">
                Carrinho
            </a>

            <a href="{{ route('orders') }}">
                Pedidos
            </a>

            <a href="{{ route('profile.index') }}

            ">Perfil

            </a>

            <span class="header-user">
                Olá, {{ auth()->user()->name }}
            </span>

            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="btn-outline dark"
                >
                    Sair
                </button>
            </form>

        </nav>

    </div>

</header>
