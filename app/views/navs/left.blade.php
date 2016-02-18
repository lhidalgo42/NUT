<?php $hasRole = new Acme\helpers\hasRole(); ?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            @if($hasRole::All())
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            @endif
                @if($hasRole::Therapist())
            <li>
                <a href="/therapist/calendar/add"><i class="fa fa-calendar-plus-o"></i></i>Agregar Hora</a>
            </li>
                @endif
                @if($hasRole::Administrador() || $hasRole::Secretaria())
            <li>
                <a href="#"><i class="fa fa-calendar"></i> Calendario<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li>
                         <a href="/calendar/add">Agregar Hora</a>
                    </li>
                    <li>
                        <a href="/therapist/calendar/add">Agregar una Hora a Mi Calendario</a>
                    </li>
                    <li>
                        <a href="/my/calendar">Mi Calendario</a>
                    </li>
                    <li>
                        <a href="/calendar/therapist">Calendario por Terapeuta</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
                @endif
            <li>
                <a href="#"><i class="fa fa-users"></i> Pacientes<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li>
                        <a href="/patients">Ver Listado de Pacientes</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
                @if($hasRole::Administrador() || $hasRole::Secretaria())
            <li>
                <a href="#"><i class="fa fa-users"></i> Terapeutas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li>
                        <a href="/therapists">Ver Listado de Terapeutas</a>
                    </li>
                    <li>
                        <a href="/therapists/config">Configuraciones</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
                @endif
                @if($hasRole::Administrador() || $hasRole::Secretaria())
            <li>
                <a href="/rooms"><i class="fa fa-bookmark"></i> Salas y Salones</a>
            </li>
                @endif

                @if($hasRole::Therapist())
            <li>
                <a href="/my/durations"><i class="fa fa-clock-o"></i> Mis Duraciones</a>
            </li>
                @endif
                @if($hasRole::Administrador() || $hasRole::Secretaria())
                    <li>
                        <a href="#"><i class="fa fa-dollar"></i> Finanzas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false">
                            <li>
                                <a href="/finance/therapists"><i class="fa fa-money"></i> Pagos Pendientes</a>
                            </li>
                            <li>
                                <a href="/finance/exprenses"><i class="fa fa-arrow-right"></i> Egresos</a>
                            </li>
                            <li>
                                <a href="/finance/income"><i class="fa fa-arrow-left"></i> Ingresos </a>
                            </li>
                            <li>
                                <a href="/finance/voucher"><i class="fa fa-ticket"></i> Recibos</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                @endif
                @if($hasRole::Administrador() || $hasRole::Secretaria())
                    <li>
                        <a href="/admin"><i class="fa fa-bookmark"></i> Admin</a>
                    </li>
                @endif
            <li>
                <a href="/logout"><i class="fa fa-sign-out"></i> Cerrar Sesión </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->