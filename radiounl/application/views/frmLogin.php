<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SIUS">
        <meta name="author" content="Kevin Atiencia">

        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url() ?>modelador/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>modelador/css/Tablas.css">
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/JsValidacion.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/treeMenu.js"></script> 
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/jquery.validate.js"></script>
        <script>
            function validarFormulario() {
                jQuery.validator.messages.required = "<code>Esta campo es obligatorio.</code>";
                jQuery.validator.messages.number = "<code>Esta campo debe ser numerico.</code>";
                jQuery.validator.messages.email = '<code>Correo electronico invalido</code>';
                $("#formulario").validate();
            }
            function validarFormularioR() {
                jQuery.validator.messages.required = "<code>Esta campo es obligatorio.</code>";
                jQuery.validator.messages.number = "<code>Esta campo debe ser numerico.</code>";
                jQuery.validator.messages.email = '<code>Correo electronico invalido</code>';
                $("#formularioR").validate();
            }
            $(document).ready(function () {
                validarFormulario();
                validarFormularioR();
            });
        </script>
        <script>
            $(document).on('ready', function () {
                $('#show-hide-passwd').on('click', function (e) {
                    e.preventDefault();
                    var current = $(this).attr('action');
                    if (current == 'hide') {
                        $(this).prev().attr('type', 'text');
                        $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action', 'show');
                    }
                    if (current == 'show') {
                        $(this).prev().attr('type', 'password');
                        $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action', 'hide');
                    }
                })
            })
        </script>
    </head>
    <body>
        <div class="container">    
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <?php
                if (isset($message)) {
                    echo "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    echo $message;
                    echo "</div>";
                }
                ?>
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Iniciar Sesión</div>
                    </div>
                    <div style="padding-top:30px" class="panel-body" >
                        <?php echo form_open('login/validar', 'id="formulario" name="formulario" class="form-horizontal"'); ?>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span title="iconUsr" class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input title="inputemail" id="email" name="email" type="mail"  class="form-control required email"  placeholder="Ingrese su Email">
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span title="iconPass" class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input title="inoutpass" id="password" type="password" class="form-control required" name="password" placeholder="Ingrese su Password">
                            <span id="show-hide-passwd" action="hide"  class="input-group-addon glyphicon glyphicon-eye-open"></span>
                        </div>
                        <div>
                            <a data-toggle="modal" data-target="#myModal">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div style="margin-top:10px; margin: 1rem;padding: 1rem;text-align: center;" class="form-group">
                            <div class="col-sm-12 controls">
                                <button title="save" id="save" type="submit" onclick= "" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesión</button>
                            </div>
                        </div>
                        <div class="form-group"><br><br><br>
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" ></div>
                            </div>
                        </div>    
                        <?php echo form_close(); ?>
                    </div>                     
                </div>  
            </div>
        </div> 
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" title="cerrar" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 title="cabezeratxt"style="margin: 1rem;text-align: center;"  class="modal-title" id="myModalLabel">Desea Ingresar al Sistema de la Radio Universitaria</h3>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('login/RecuperarClave', 'id="formularioR" name="formularioR" class="form-horizontal"'); ?>
                        <h4>Olvido su correo: Ingresa el correo de respaldo para tener acceso.</h4>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                            <input title="correoAlt" id="correoAlter" name="correoAlter" type="email" class="form-control required email"  placeholder="Teclea su correo electronico alternativo">
                        </div><br>
                        <div class="input-group-btn" style="margin: 1rem;text-align: center;">
                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-send"></i> Enviar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="modal-footer">
                        <button title="cerrarfooter" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>