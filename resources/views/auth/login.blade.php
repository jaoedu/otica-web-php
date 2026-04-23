<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ótica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <main class="auth-wrapper">
        <section class="auth-card">
            <div class="auth-brand">
                <span class="brand-badge">Ótica Web</span>
                <h1>Bem-vindo de volta</h1>
                <p>Entre com sua conta para acessar sua área, pedidos e produtos.</p>
            </div>

            @if (session('status'))
                <div class="alert success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="seuemail@exemplo.com"
                    >
                    @error('email')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="Digite sua senha"
                    >
                    @error('password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-row">
                    <label class="checkbox">
                        <input type="checkbox" name="remember">
                        <span>Lembrar de mim</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="form-link">Esqueci minha senha</a>
                    @endif
                </div>

                <button type="submit" class="btn-primary">Entrar</button>

                <p class="auth-footer-text">
                    Ainda não tem conta?
                    <a href="{{ route('register') }}">Criar cadastro</a>
                </p>
            </form>
        </section>
    </main>
</body>
</html>
