<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Ventas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ventas-nueva') }}">
                        <i class="bi bi-circle"></i><span>Vender Productos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ventas-detalles') }}">
                        <i class="bi bi-circle"></i><span>Consultas Ventas</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('categorias') }}">
                <i class="bi bi-question-circle"></i>
                <span>Categorias</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('productos') }}">
                <i class="bi bi-envelope"></i>
                <span>Productos</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('clientes') }}">
                <i class="bi bi-card-list"></i>
                <span>Clientes</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('usuarios') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Usuarios</span>
            </a>
        </li><!-- End Login Page Nav -->


    </ul>

</aside>
