<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 asideMain">
    <!-- Brand Logo -->
    @guest
        <a href=" {{ url('/') }}" class="brand-link">
            <span class="brand-text font-weight-light" style="margin-left: 25%;">{{ config('app.name', 'Laravel') }}</span>
        </a>
    @else
        <a href="{{ url('/home') }}" class="brand-link">
            <span class="brand-text font-weight-light" style="margin-left: 25%;">{{ config('app.name', 'Laravel') }}</span>
        </a>
    @endguest
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
        @auth
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image" style="margin-top: auto; margin-bottom: auto;">
                    @if (isset(Auth::user()->avatar))
                        <img src="{{asset("storage").'/'.Auth::user()->avatar}}" class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="{{asset("/img/user_default.png")}}" class="img-circle elevation-2" alt="User Image">
                    @endif
                </div>
                <div class="info">
                    <span class="user-status">
                        <span>
                            <a href="{{route('users.ver', Crypt::encrypt(Auth::user()->id))}}" class="d-block">
                                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                            </a>
                        </span>
                        <span style="color: #FFFFFF">
                            @foreach (Auth::user()->getRelationRoleUser() as $role)
                                {{$role->name}}
                            @endforeach
                        </span>
                        <br>
                        <i class="fa fa-circle"></i>
                        <span style="color: #FFFFFF">Online</span>
                    </span>
                </div>
            </div>
            {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="far fa-id-badge" style="color:#FFFFFF; padding-left: 5px; font-size:24px;"></i>
                </div>
                <div class="info">
                    <span style="color: #FFFFFF">
                        @foreach (Auth::user()->getRelationRoleUser() as $role)
                            {{$role->name}}
                        @endforeach
                    </span>
                </div>
            </div> --}}
            @can('page.index')
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fas fa-cogs" style="color:#FFFFFF; font-size:24px;"></i>   
                </div>
                <div class="info">
                    <a class="d-block" href="{{ route('inicio.editarPagina') }}">Configuraci&oacute;n</a>
                </div>
            </div>
            @endcan
        @endauth
        <!-- Sidebar Menu -->
        <nav class="mt-2 navbarAside">
            <ul class="nav nav-pills nav-sidebar flex-column" 
                data-widget="treeview" role="menu" data-accordion="false" id="colorlinks">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                @guest
                    <li class="nav-item navColorItems">
                        <a href="#misionvision" class="nav-link">
                        <i class="far fa-question-circle" style="padding-left: 5px; font-size:24px;"></i>
                        <p>
                            ¿Qui&eacute;nes Somos?
                        </p>
                        </a>
                    </li>
                @endguest
                @guest
                    <li class="nav-item navColorItems">
                        <a href="#contactanos" class="nav-link">
                        <i class="fas fa-envelope-square" style="padding-left: 5px; font-size:24px;"></i>
                        <p>
                            Cont&aacute;ctanos
                        </p>
                        </a>
                    </li>
                @endguest
                @auth
                <li class="nav-item navColorItems">
                    <a href="{{ route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="padding-left: 5px; font-size:20px;"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endauth
                @can('localizaciones.index')
                <li class="nav-item navColorItems">
                    <a href="{{ route('localizaciones.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-university" style="padding-left: 5px; font-size:20px;"></i>
                        <p>
                            Laboratorios
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('areas.index')
                <li class="nav-item navColorItems">
                    <a href="{{ route('areas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th" style="padding-left: 5px; font-size:20px;"></i>
                        <p>
                            Áreas
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('sistemas.index')
                <li class="nav-item navColorItems">
                    <a href="{{ route('sistemas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th" style="padding-left: 5px; font-size:20px;"></i>
                        <p>
                            Sistemas
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('equiposprestamos.index')
                <li class="nav-item navColorItems">
                    <a href="{{ route('equiposprestamos.index') }}" class="nav-link">
                        <i class="fas fa-people-carry" style="padding-left: 5px; font-size:20px;"></i>
                        <p>
                            Prestar Equipos
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('users.index') 
                <li class="nav-item navColorItems">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fa fa-users" style="padding: 5px; font-size:20px;"></i>
                        <p>
                            Usuarios
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('roles.index') 
                <li class="nav-item navColorItems">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="far fa-address-card" style="padding: 5px; font-size:20px;"></i>
                        <p>
                            Roles
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('messages.index')
                <li class="nav-item navColorItems">
                    <a href="{{ route('messages.index') }}" class="nav-link">
                        <i class="fas fa-envelope-square" style="padding-left: 5px; font-size:20px;"></i>
                        <p>
                            Mensajes
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('mantenimientos.index')
                <li class="nav-item navColorItems">
                    <a href="{{ route('mantenimientos.index') }}" class="nav-link">
                        <i class="fas fa-tools" style="padding-left: 5px; font-size:20px;"></i>
                        <p>
                            Mantenimientos
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('report.download')
                <li class="nav-item navColorItems">
                    <a href="{{ route('reporte.index') }}" class="nav-link">
                        <i class="far fa-clipboard" style="padding-left: 5px; font-size:25px;"></i>
                        <p>
                            Reportes
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('page.index')
                    {{-- <li class="nav-item navColorItems">
                        <a class="nav-link" href="{{ route('inicio.editarPagina') }}">
                            <i class="fas fa-sync-alt" style="padding: 5px;"></i>
                            <p>
                                Actualizar P. Inicio
                            </p>
                        </a>
                    </li> --}}
                @endcan
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>