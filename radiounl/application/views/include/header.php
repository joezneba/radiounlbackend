<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php
        if (isset($this->session->userdata['esta_logeado'])) {
            $nombre = ($this->session->userdata['esta_logeado']['nombre']);
            $apellido = ($this->session->userdata['esta_logeado']['apellido']);
        } else {
            session_destroy();
            header("location:" . base_url());
            die();  
        }
        ?>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="RADIO UNIVERSITARIA"/>
        <meta name="author" content="Jonathan Neira"/>

        <title><?php echo $title; ?></title>

        <!-- Java Script -->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/bootstrap3-typeahead.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>modelador/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>modelador/js/JsValidacion.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/treeMenu.js"></script> 
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/notificaciones.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/notificacionUS.js"></script><!--
        <!-- CSS -->
        <link href="<?php echo base_url() ?>modelador/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>modelador/css/style.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>modelador/css/dashboard.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>modelador/css/menu.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>modelador/css/Tablas.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>modelador/css/iconos/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>modelador/css/jquery-ui.css"/> 
        <link href="<?php echo base_url() ?>modelador/css/sb-admin.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>modelador/css/plugins/morris.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>modelador/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            var baseurl = "<?php echo base_url(); ?>";
        </script>
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() ?>index.php/login/page_Admin">RADIO UNIVERSITARIA</a>
                </div>

                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ' ' . $this->encrypt->decode($nombre); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <?php echo anchor('usuario/index', '<i class="fa fa-fw fa-user"></i> Mis Datos'); ?> 
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?php echo anchor('login/logout', '<i class="fa fa-fw fa-power-off"></i> Salir'); ?>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <script>
                                function buscar() {
                                    var dato = $("#datoBuscar").val();
                                    if (dato === "") {
                                        alert("Debe Ingresar información");
                                        return false;
                                    } else {
                                        var formulario = document.getElementById("buscarUS");
                                        formulario.submit();
                                        return true;
                                    }
                                }

                            </script>

                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>index.php/login/page_Admin"><i class="fa fa-fw fa-home"></i>Inicio</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>index.php/noticia/listaNoticias"><i class="fa fa-fw fa-hospital-o"></i>Noticias</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>index.php/programa/listaProgramas"><i class="fa fa-fw fa-hospital-o"></i>Parrilla de Programación</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>index.php/programagrabado/listaProgramasGrabados"><i class="fa fa-fw fa-hospital-o"></i>Programas Grabados</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>index.php/banner/listaBanners"><i class="fa fa-fw fa-hospital-o"></i>Banner</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper">
                <div class="container-fluid">   
                    <?php $this->load->view($main); ?>     
                </div> 
            </div>   
        </div>
    </body>
</html>


