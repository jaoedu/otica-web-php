<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ótica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-page">
    <header class="topbar">
        <div>
            <span class="brand-badge">Ótica Web</span>
            <h1 class="dashboard-title">Área do usuário</h1>
        </div>

        <div class="topbar-actions">
            <span class="welcome-user">Olá, {{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-outline">Sair</button>
            </form>
        </div>
    </header>

    <main class="dashboard-container">
        <section class="dashboard-card">
            <h2>Login realizado com sucesso</h2>
            <p>Seu sistema de autenticação já está funcionando. Agora podemos continuar com produtos, carrinho e pedidos.</p>
        </section>

        <section class="dashboard-grid">
            <article class="mini-card">
                <h3>Cadastro</h3>
                <p>Usuários podem criar conta normalmente.</p>
            </article>

            <article class="mini-card">
                <h3>Login</h3>
                <p>Usuários entram e acessam área protegida.</p>
            </article>

            <article class="mini-card">
                <h3>Logout</h3>
                <p>A sessão pode ser encerrada com segurança.</p>
            </article>
        </section>
    </main>
</body>
</html>
