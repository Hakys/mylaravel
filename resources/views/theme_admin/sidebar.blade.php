<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li><a href="/home"><i class="fa fa-dashboard fa-fw"></i> Panel de Control</a></li>
            <li><a href="/clientes"><i class="fa fa-users fa-fw"></i> Clientes</a></li>            
            <li><a href="/consultas"><i class="fa fa-users fa-fw"></i> Historico Consultas</a></li>
            <li><a href="/diario"><i class="fa fa-calendar fa-fw"></i>Calendario BS</a></li>
            <li><a href="{{route('hoy')}}"><i class="fa fa-calendar fa-fw"></i>Consultas para Hoy</a></li>
            <li><a href="/calendario"><i class="fa fa-calendar fa-fw"></i> Calendario Javascript</a></li>
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Plantillas de Ejemplo<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="/themes/4.0.0/sb-admin-2/pages/flot.html">Flot Charts</a>
                            </li>
                            <li>
                                <a href="/themes/4.0.0/sb-admin-2/pages/morris.html">Morris.js Charts</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                    <li>
                        <a href="/themes/4.0.0/sb-admin-2/pages/tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                    </li>
                    <li>
                        <a href="/themes/4.0.0/sb-admin-2/pages/forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="/themes/4.0.0/sb-admin-2/pages/panels-wells.html">Panels and Wells</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="/themes/4.0.0/sb-admin-2/pages/blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="/themes/4.0.0/sb-admin-2/pages/login.html">Login Page</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->