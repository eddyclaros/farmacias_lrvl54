<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
            </li>
            <!-- <li class="nav-title">
                Mantenimiento
            </li> -->
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Administracion</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Sucursales</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Almacenes</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=70" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Codificacion</a>
                    </li>
                    <li @click="menu=71" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Ingreso Productos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Servicios</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Areas</a>
                    </li>
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Prestaciones</a>
                    </li>
                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Venta Servicios</a>
                    </li>
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Historial Ventas</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Configuraciones</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Desc. Servicios</a>
                    </li>
                    <li @click="menu=31" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Desc. Productos</a>
                    </li>
                    <!-- <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i> Validaciones</a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Productos</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=60" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Lineas</a>
                    </li>
                    <li @click="menu=61" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i> Registro Producto</a>
                    </li>
                    <li @click="menu=62" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Dispenser</a>
                    </li>
                    <li @click="menu=63" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Forma Farmaceutica</a>
                    </li>
                    <li @click="menu=64" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Categorias</a>
                    </li>
                </ul>
            </li>
            <!--
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                    </li>
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=9" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ingresos</a>
                    </li>
                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                    </li>
                </ul>
            </li>
            <li  @click="menu=11" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
            </li>
            <li @click="menu=12" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
            </li> -->
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>