<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SGIAM">
        <meta name="author" content="Kevin Atiencia">

        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url() ?>modelador/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>modelador/css/Tablas.css">
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>modelador/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>modelador/js/JsValidacion.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/treeMenu.js"></script> 
        <script type="text/javascript" src="<?php echo base_url() ?>modelador/js/jquery.validate.js"></script>

        <script type="text/javascript">
            var baseurl = "<?php echo base_url(); ?>";
        </script>
        <script>
            function validarFormulario() {
                jQuery.validator.messages.required = "<code>Esta campo es obligatorio.</code>";
                jQuery.validator.messages.number = "<code>Esta campo debe ser numerico.</code>";
                jQuery.validator.messages.email = '<code>Correo electronico invalido</code>';
                $("#formulario").validate();
            }
            $(document).ready(function() {
                validarFormulario();
            });
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
                    <div class="panel-heading form-group">
                        <div class="panel-title">Iniciar Sesión <a class="btn btn-default"href="<?php echo base_url(); ?>index.php/login/index"> Atras</a></div>  
                    </div>
                    <div style="padding-top:30px" class="panel-body" >
                        <?php echo form_open('login/validarPregunta', 'id="formulario" name="formulario" class="form-horizontal"'); ?>
                        <input id="idUsuario" name="idUsuario" type="text" style="display: none;" value=<?php echo $idUsuario ?>>
                        <center>
                            <label class="col-lg-12">¿CUAL ES SU TRABAJO IDEAL?</label>
                            <br><br>
                            <div style="margin-bottom: 25px" class="input-group col-lg-6">
                                <input id="respuesta" name="respuesta" type="password"  class="form-control required"  placeholder="Ingrese Su Respuesta">
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                    <center>
                                        <button id="save" type="submit" onclick= "" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesión</button>
                                    </center>
                                </div>
                            </div></center>
                        <?php echo form_close(); ?>
                    </div>                     
                </div>  
            </div>
        </div>
    </body>
</html>