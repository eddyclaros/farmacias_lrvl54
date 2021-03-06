<div class="sidebar ">
    <nav class="sidebar-nav">
        <ul class="nav" style="height: auto;">
            <li  class="nav-item" id="0">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> INICIO</a>
            </li>
            <li class="nav-title">
                Menu Opciones
            </li>

            <?php use App\Http\Controllers\ParVentanaModuloController;
                $vent=ParVentanaModuloController::listarPermisos();
                
            ?>
            
            @foreach ($vent as $item)
                <li class="nav-item nav-dropdown menudown ">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> 
                        <font color="turquoise" style="text-transform:capitalize">{{ $item->nombre }}</font>
                    </a>
                    <ul class="nav-dropdown-items">
                        @foreach($item->ventana as $ventana)
                            <li @click="menu={{ $ventana->codventana }}" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i>{{ $ventana->nomventana }} </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach


            <!-- <li class="nav-title">
                Mantenimiento
            </li> -->
           {{--  <li class="nav-item nav-dropdown menudown ">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> 
                    <font color="turquoise" style="text-transform:capitalize">Administracion</font>
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Sucursales</a>
                    </li>
                </ul>
                <ul class="nav-dropdown-items">
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Cargos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown menudown ">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-user"></i> 
                    <font color="turquoise" style="text-transform:capitalize">Recursos Humanos</font>
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=20" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-user"></i> Configuraciones</a>
                    </li>
                </ul>
                
            </li>
            <li class="nav-item nav-dropdown menudown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>
                    <font color="turquoise" style="text-transform:capitalize">Almacenes</font>
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=70" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Codificacion</a>
                    </li>
                    <li @click="menu=71" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Ingreso Productos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown menudown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> 
                    <font color="turquoise" style="text-transform:capitalize">Servicios</font> 
                </a>
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
            <li class="nav-item nav-dropdown menudown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> 
                    <font color="turquoise" style="text-transform:capitalize">Configuraciones</font> 
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Desc. Servicios</a>
                    </li>
                    <li @click="menu=31" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Desc. Productos</a>
                    </li>
                   
                </ul>
            </li>
            <li class="nav-item nav-dropdown menudown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> 
                    <font color="turquoise" style="text-transform:capitalize">Productos</font> 
                </a>
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
            </li> --}}
            <!--
            <li class="nav-item nav-dropdown menudown">
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
            <li class="nav-item nav-dropdown menudown">
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