<footer class="site-footer">

    <div class="footer-container">

        <div class="footer-brand">
            <h3>Ótica Márcia</h3>

            <p>
                Qualidade, conforto e estilo para sua visão.
                Trabalhamos com lentes, armações e acessórios
                com preços especiais.
            </p>
        </div>

        <div class="footer-column">
            <h4>Navegação</h4>

            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('cart.index') }}">Carrinho</a>
                <a href="{{ route('orders') }}">Pedidos</a>
            </div>
        </div>

        <div class="footer-column">
            <h4>Contato</h4>

            <div class="footer-links">
                <a href="#">📍 Maceió - AL</a>
                <a href="#">📞 (82) 99999-9999</a>
                <a href="#">✉ contato@oticamarcia.com</a>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        © {{ date('Y') }} Ótica Márcia — Todos os direitos reservados.
    </div>

</footer>
