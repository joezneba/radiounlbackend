<?php


$foto2 = array(
    'id' => 'Foto2',
    'name' => 'Foto2',
    'size' => '15',
    'value' => set_value('foto2')
);

?>
<script>
    function validarFormulario() {
        jQuery.validator.messages.required = "<code>Esta campo es obligatorio.</code>";
        jQuery.validator.messages.number = "<code>Esta campo debe ser num&eacute;rico.</code>";
        jQuery.validator.messages.minlength = "<code>Debe contener mínimo 4 numeros.</code>";
        $("#formulario").validate();
    }
    $(document).ready(function() {
        validarFormulario();
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <span class="glyphicon glyphicon-th-list"></span> <?php echo $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i> <a href="<?php echo base_url() ?>index.php/login/page_Admin">Inicio</a>
            </li>
            <li class="active">
                <i class="fa fa-list"></i> <?php echo $title; ?>
            </li>
        </ol>
    </div>
</div>
<div>    
    <?php
    if ($this->session->flashdata('error')) {
        echo "<div class='alert alert-success text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>";
        echo '<h4><center>' . $this->session->flashdata('error') . '</h4></center>';
        echo "</div>";
    }
    echo form_open_multipart('banner/guardarBanner2/', 'id="formulario" name="formulario"class="form-horizontal"');
    ?>
    <div class="wrapper">
        <div class="form-group col-lg-12">
            <label for="Estatus" class="col-lg-2 control-label">BANNER 2 :</label>
            <div class="col-lg-4">
                <?php echo form_upload($foto2); ?>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <div class="col-lg-10">
                <a type="button" href="<?php echo base_url(); ?>index.php/login/page_Admin" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Guardar</button>
            </div>
        </div>
        <hr/>
    </div>
    <?php echo form_close(); ?>
</div>