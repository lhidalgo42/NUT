    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><img src="/img/logo-top.png" style="width: 2%;position: absolute;"> <span style="margin-left: 35px;">NUT</span></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{Auth::user()->name}}  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <!--<li><a href="/profile"><i class="fa fa-user fa-fw"></i>Perfil de Usuario</a>
                </li> -->
                <li><a href="/history"><i class="fa fa-history fa-fw"></i> Mi Historial</a>
                </li>
                <li>
                    <a href="/my/calendar"> <i class="fa fa-calendar fa-fw"></i>Mi Calendario</a>
                </li>
               <!-- <li><a href="/config"><i class="fa fa-gear fa-fw"></i> Configuraciones</a>
                </li> -->
                <li class="divider"></li>
                <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->