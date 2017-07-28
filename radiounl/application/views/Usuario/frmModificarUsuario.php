<script src="<?php echo base_url() ?>modelador/js/index.js"></script>
<input type="hidden" value="<?php echo $datosU['IDUSUARIO'] ?>" id="id" name="id"> 
<?php
$Nombre = array(
    'name' => 'Nombre',
    'id' => 'Nombre',
    'size' => 50,
    'value' => $this->encrypt->decode($datosU['NOMBRE']),
    'type' => 'text',
    'class' => 'required form-control',
    'style' => 'text-transform:uppercase',
);

$Apellido = array(
    'name' => 'Apellido',
    'id' => 'Apellido',
    'size' => 50,
    'value' => $this->encrypt->decode($datosU['APELLIDO']),
    'type' => 'text',
    'class' => 'required form-control',
    'style' => 'text-transform:uppercase',
);

$Password1 = array(
    'name' => 'pass1',
    'id' => 'pass1',
    'autofocus' => 'autofocus',
    'value' => set_value('password1', $this->encrypt->decode($datosU['CLAVE'])),
    'type' => 'password',
    'class' => 'required form-control',
);
$Password2 = array(
    'name' => 'pass2',
    'id' => 'pass2',
    'autofocus' => 'autofocus',
    'value' => set_value('password2', $this->encrypt->decode($datosU['CLAVE'])),
    'type' => 'password',
    'class' => 'required form-control',
);
$cedula = array(
    'name' => 'cedula',
    'id' => 'cedula',
    'size' => 50,
    'value' => $this->encrypt->decode($datosU['CEDULA']),
    'type' => 'number',
    'class' => 'required number form-control'
);
$email = array(
    'name' => 'email',
    'id' => 'email',
    'size' => 50,
    'value' => $this->encrypt->decode($datosU['CORREO']),
    'type' => 'email',
    'class' => 'required email form-control'
);

$emailRespaldo = array(
    'name' => 'emailRespaldo',
    'id' => 'emailRespaldo',
    'size' => 50,
    'value' => $this->encrypt->decode($datosU['CORREORESPALDO']),
    'type' => 'email',
    'class' => 'required email form-control'
);

$direccion = array(
    'name' => 'direccion',
    'id' => 'direccion',
    'size' => 100,
    'value' => $this->encrypt->decode($datosU['DIRECCION']),
    'type' => 'text',
    'class' => 'required form-control',
);
$telefono = array(
    'name' => 'telefono',
    'id' => 'telefono',
    'size' => 50,
    'value' => $this->encrypt->decode($datosU['TELEFONO']),
    'type' => 'number',
    'class' => 'required number form-control'
);
$respuesta = array(
    'name' => 'respuesta',
    'id' => 'respuesta',
    'size' => 50,
    'value' => $this->encrypt->decode($datosU['RESPUESTA']),
    'type' => 'text',
    'class' => 'required form-control'
);
$FOTO = array(
    'id' => 'Foto',
    'name' => 'Foto',
    'size' => '15',
    'value' => set_value('foto')
);
?>
<script>
    function validarFormulario() {
        jQuery.validator.messages.required = "<code>Esta campo es obligatorio.</code>";
        jQuery.validator.messages.number = "<code>Esta campo debe ser num&eacute;rico.</code>";
        jQuery.validator.messages.email = '<code>Correo electronico invalido</code>';
        $("#formulario").validate();
    }
    $(document).ready(function() {
        validarFormulario();
    });
</script>
<div class="contents">
    <h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span> <?php echo $title; ?> <a type="button" href="<?php echo base_url() ?>index.php/login/page_Admin/" class="btn btn-default">Regresar</a></h1>   
    <div id="mensaje"></div>

    <?php echo form_open_multipart('usuario/modificarFoto/' . $datosU['IDUSUARIO']); ?>
    <div class="row-border">
        <div class="foto">
            <div class="input-group">
                <label for="Estatus" class=" control-label">FOTO OFICIAL </label>
            </div>
            <div>
                <?php echo form_upload($FOTO); ?>
            </div>
            <div>
                <img  src= "<?php echo base_url() . $datosU['FOTO']; ?>" style="width: 190px; height: 170px;"data-holder-rendered="true" alt= "140x140"  class= "img-thumbnail" >
            </div>
            <div id="btn-guardar">
                <button type="submit" class="btn btn-primary" id="guardarF" name="guardarF" >Cambiar Imagen</button> 
            </div>
        </div>
        <?php echo form_close(); ?>
        <?php echo form_open('usuario/guardar/' . $datosU['IDUSUARIO'], 'id="formulario" name="formulario"'); ?>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="apellidos" class="col-lg-3 control-label">Nombre:</label>
                <div class="col-lg-12">
                    <?php echo form_input($Nombre) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="apellidos" class="col-lg-3 control-label">Apellidos:</label>
                <div class="col-lg-12">
                    <?php echo form_input($Apellido) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password1" class="col-lg-3 control-label">Password:</label>
                <div class="col-lg-12">
                    <?php echo form_input($Password1) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Confirmar Password:</label>
                <div class="col-lg-12">
                    <?php echo form_input($Password2) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Cedula:</label>
                <div class="col-lg-12">
                    <?php echo form_input($cedula) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Correo:</label>
                <div class="col-lg-12">
                    <?php echo form_input($email) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Correo Respaldo:</label>
                <div class="col-lg-12">
                    <?php echo form_input($emailRespaldo) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Dirección:</label>
                <div class="col-lg-12">
                    <?php echo form_input($direccion) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Telefono:</label>
                <div class="col-lg-12">
                    <?php echo form_input($telefono) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="password2" class="col-lg-8 control-label">¿CUAL ES SU TRABAJO IDEAL?</label>
                <div class="col-lg-12">
                    <?php echo form_input($respuesta) . br(1); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-12">
            <div class="form-group">
                <center><button type="submit" name="enviar" value="Enviar" class="btn btn-success"><span class="glyphicon glyphicon-saved"></span> Guardar</button></center>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

