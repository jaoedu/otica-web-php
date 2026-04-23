<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Ótica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <main class="auth-wrapper">
        <section class="auth-card">
            <div class="auth-brand">
                <span class="brand-badge">Ótica Márcia</span>
                <h1>Crie sua conta</h1>
                <p>Cadastre-se para acessar seus pedidos, favoritos e recursos da plataforma.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        placeholder="Seu nome completo"
                    >
                    @error('name')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
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
                        placeholder="Crie uma senha"
                    >
                    @error('password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar senha</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Confirme sua senha"
                    >
                </div>

                <button type="submit" class="btn-primary">Cadastrar</button>

                <p class="auth-footer-text">
                    Já tem conta?
                    <a href="{{ route('login') }}">Entrar</a>
                </p>
            </form>
        </section>
    </main>
</body>
</html>
