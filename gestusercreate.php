<?php

/*
This file is part of McWebPanel.
Copyright (C) 2020 Cristina Ibañez, Konata400

    McWebPanel is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    McWebPanel is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with McWebPanel.  If not, see <https://www.gnu.org/licenses/>.
*/

require_once("template/session.php");
require_once("template/errorreport.php");
require_once("config/confopciones.php");
require_once("template/header.php");
?>
<!-- Custom styles for this template-->
<link href="css/test.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php

    $expulsar = 0;

    //COMPROVAR SI SESSION EXISTE SINO CREARLA CON NO
    if (!isset($_SESSION['VALIDADO']) || !isset($_SESSION['KEYSECRETA'])) {
        $_SESSION['VALIDADO'] = "NO";
        $_SESSION['KEYSECRETA'] = "0";
        header("location:index.php");
        exit;
    }

    //COMPROVAR SI ES EL SUPERADMIN O ADMIN
    if (array_key_exists('rango', $_SESSION['CONFIGUSER'])) {
        if ($_SESSION['CONFIGUSER']['rango'] == 1 || $_SESSION['CONFIGUSER']['rango'] == 2) {
            $expulsar = 1;
        }
    }

    if ($expulsar != 1) {
        header("location:index.php");
        exit;
    }

    //VALIDAMOS SESSION SINO ERROR
    if ($_SESSION['VALIDADO'] == $_SESSION['KEYSECRETA']) {
    ?>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php
            require_once("template/menu.php");
            ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body">
                                    <div class="py-1">
                                        <div class="container">
                                            <h1 class="mb-5">Crear Usuario</h1>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <form action="function/gestusercrearusuario.php" method="POST" id="form-createuser">
                                                        <div class="py-1">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="eluser" class="">Nombre Usuario</label>
                                                                            <input type="text" class="form-control" id="eluser" name="eluser" required="required">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="elpass">Contraseña</label>
                                                                        <input type="password" class="form-control" id="elpass" name="elpass" placeholder="••••" required="required">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="elrepass">Confirmar Contraseña</label>
                                                                        <input type="password" class="form-control" id="elrepass" name="elrepass" placeholder="••••" required="required">
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <p class="lead" id="textoretorno"></p>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <label>Asignar Permisos:</label>
                                                                        <br><br>

                                                                        <!-- STATUS -->
                                                                        <div class="card-header text-white bg-primary">Pagina Status</div>
                                                                        <div class="card-body border">

                                                                            <input id="pstatusstarserver" name="pstatusstarserver" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pstatusstarserver">Iniciar Servidor</label>

                                                                            <input id="pstatusstopserver" name="pstatusstopserver" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pstatusstopserver">Apagar Servidor</label>

                                                                            <input id="pstatuskillserver" name="pstatuskillserver" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pstatuskillserver">Kill Servidor</label>

                                                                        </div>

                                                                        <!-- Consola -->
                                                                        <div class="card-header text-white bg-primary">Pagina Consola</div>
                                                                        <div class="card-body border">

                                                                            <input id="pconsolaread" name="pconsolaread" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pconsolaread">Acceder y Leer Consola</label>

                                                                            <input id="pconsolaenviar" name="pconsolaenviar" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pconsolaenviar">Enviar Comando</label>

                                                                        </div>

                                                                        <!-- CONFIG MINECRAFT -->
                                                                        <div class="card-header text-white bg-primary">Pagina Config Minecraft</div>
                                                                        <div class="card-body border">

                                                                            <input id="pconfmine" name="pconfmine" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pconfmine">Acceder y Configurar</label>

                                                                        </div>

                                                                        <!-- PROG TAREAS -->
                                                                        <div class="card-header text-white bg-primary">Pagina Prog Tareas</div>
                                                                        <div class="card-body border">

                                                                            <input id="pprogtareas" name="pprogtareas" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pprogtareas">Acceder</label>

                                                                            <input id="pprogtareascrear" name="pprogtareascrear" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pprogtareascrear">Crear Tareas</label>

                                                                            <input id="pprogtareasactdes" name="pprogtareasactdes" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pprogtareasactdes">Activar / Desactivar Tareas</label>

                                                                            <input id="pprogtareasborrar" name="pprogtareasborrar" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pprogtareasborrar">Borrar Tareas</label>

                                                                        </div>

                                                                        <!-- SYSTEM CONFIG -->
                                                                        <div class="card-header text-white bg-primary">Pagina System Config</div>
                                                                        <div class="card-body border">

                                                                            <input id="psystemconf" name="psystemconf" type="checkbox" value="1">
                                                                            <label class="mr-2" for="psystemconf">Acceder y Configurar</label>

                                                                        </div>

                                                                        <!-- SUBIR SERVIDOR -->
                                                                        <div class="card-header text-white bg-primary">Pagina Subir Servidor</div>
                                                                        <div class="card-body border">

                                                                            <input id="psubirservidor" name="psubirservidor" type="checkbox" value="1">
                                                                            <label class="mr-2" for="psubirservidor">Acceder y Configurar</label>

                                                                        </div>

                                                                        <!-- Backups -->
                                                                        <div class="card-header text-white bg-primary">Pagina Backups</div>
                                                                        <div class="card-body border">

                                                                            <input id="pbackups" name="pbackups" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pbackups">Acceder y Configurar</label>

                                                                        </div>

                                                                        <!-- Gestor Archivos -->
                                                                        <div class="card-header text-white bg-primary">Pagina Gestor Archivos</div>
                                                                        <div class="card-body border">

                                                                            <input id="pgestorarchivos" name="pgestorarchivos" type="checkbox" value="1">
                                                                            <label class="mr-2" for="pgestorarchivos">Acceder y Configurar</label>

                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <br>
                                                                        <button class="btn btn-lg btn-primary btn-block" id="btcrearusuario" name="btcrearusuario" type="submit">Crear Usuario</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->

            <script src="js/gestusercreate.js"></script>

        </div>
    <?php
        //FINAL VALIDAR SESSION
    } else {
        header("location:index.php");
    }
    ?>

</body>

</html>