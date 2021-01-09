<nav class="main-header navbar navbar-expand navbar-white navbar-light navheaderEstilo">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
        <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        @can('messages.index')
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="{{ route('messages.index') }}">
                <i class="far fa-bell"></i>
                @if (auth()->user()->unreadnotifications->count())
                    <span class="badge badge-warning navbar-badge">
                        {{auth()->user()->unreadnotifications->count() }}
                    </span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if (auth()->user()->unreadnotifications->count())
                    <span class="dropdown-item dropdown-header">
                        {{auth()->user()->unreadnotifications->count() }} Notificaciones
                    </span>
                @endif
                <div class="dropdown-divider"></div>
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <a href="{{route('messages.info',$notification->id)}}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 
                        <span style="font-size: 12px">{{ $notification->data['data'] }}</span>                        
                    </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('markRead')}}" class="dropdown-item dropdown-footer">Marcar todos como le&iacute;do</a>
            </div>
        </li>
        @endcan
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}" style="padding: 5px; color: #fff; font-size:18px">
                    {{ __('Iniciar Sesión') }}
                </a>
            </li>
        @else
            <ul>
                <li class="nav-item" style="list-style:none;">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ __('Cerrar Sesión') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        @endguest
    </ul>
</nav>