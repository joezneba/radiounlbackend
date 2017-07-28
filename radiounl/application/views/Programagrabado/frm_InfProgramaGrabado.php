<?php
    if ($this->session->flashdata('error')) {
        echo "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>";
        echo $this->session->flashdata('error') . '</div>';
    }
    ?>
<?php
//Variables 
$titulo = array(
    'name' => 'Titulo',
    'id' => 'Titulo',
    'maxlength' => 50,
    'value' => set_value('Titulo'),
    'type' => 'text',
    'class' => 'required form-control',
    'style' => 'text-transform:uppercase',
    'placeholder' => 'Ingrese el Titulo del programa grabado'
);


$AUDIO = array(
    'id' => 'Audio',
    'name' => 'Audio',
    'size' => '15',
    'value' => set_value('audio')
);
?>
<!-- desactiva los campos y los activa al presionar edit-->
<script>
    $(document).ready(function () {
        $('#editar').on('click', function () {
            $('#Titulo').removeAttr("disabled");
            $('#editar').hide();
            $('#guardar').show();
            $('#cancelar').show();
        });
    });//attr("disabled", "disabled");
</script>

<script>
    $(document).ready(function () {
        $('#cancelar').on('click', function () {
            location.reload();
            $('#guardar').hide();
            $('#cancelar').hide();
            $('#editar').show();
        });
    });
</script>
<!-- valida el formulario-->
<script>
    function validarFormulario() {
        jQuery.validator.messages.required = "<code>Esta campo es obligatorio.</code>";
        jQuery.validator.messages.number = "<code>Esta campo debe ser numerico.</code>";
        $("#formulario").validate();
    }
    $(document).ready(function () {
        validarFormulario();
        $('#guardar').hide();
        $('#cancelar').hide();
        $('#editar').show();
    });
</script>

<div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1><span class="glyphicon glyphicon-th-list"></span> <?php echo $infProgramaGrabado[0]->TITULO; ?></h1>
            </div>
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

<div class="tab-content">
	<div id="infor" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<?php echo form_open_multipart('programagrabado/modificarAudioProGra/' . $infProgramaGrabado[0]->IDPROGRAMAGRABADO, 'class="form-horizontal"'); ?>
                    <div class="input-group">
                    	<label for="Estatus" class=" control-label">AUDIO </label>
                    </div>
                    <div class="table-responsive">
                		<?php echo form_upload($AUDIO); ?>
                    </div>
                    <div>
                        <audio src="<?php echo base_url() . $infProgramaGrabado[0]->AUDIO; ?>" preload="auto" controls></audio>
                    </div>
                    <div>
                    	<button type="submit" class="btn btn-primary" id="guardarF" name="guardarF" >Cambiar Audio</button> 
                    </div>
                <?php echo form_close(); ?>
			</div>
		<?php echo form_open('programagrabado/modificarProgramaGrabado/' . $infProgramaGrabado[0]->IDPROGRAMAGRABADO, 'id="formulario" name="formulario" class="form-horizontal"');?>
		<div class="col-lg-8 col-md-6" >
				<br>
	       	 	<button type="button"  class="btn btn-success" id="editar" name="editar" ><span class="glyphicon glyphicon-edit"></span>  Editar</button>
	        	<button type="submit"  class="btn btn-info" style="display: none" id="guardar" name="guardar"><span class="glyphicon glyphicon-floppy-save"></span>  Guardar</button>
	        	<button type="button"  class="btn btn-warning" style="display: none" id="cancelar" name="cancelar"><span class="glyphicon glyphicon-remove"></span>  Cancelar</button><br>
	       		<br>
	        <div class="form-group col-lg-12">
	          <label for="Estatus" class="col-lg-3 control-label">TITULO:</label>
	          <div class="input-group">
	          	<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
	          	<input id="Titulo" name="Titulo" disabled="true" type="text"  class="required form-control"  value="<?php echo $infProgramaGrabado[0]->TITULO ?>">
	          </div>
		</div>
		<?php echo form_close(); ?>	
		</div>
	</div>
</div>


<?php
/*echo $infNoticia[0]->TITULO."<br>";
echo $infNoticia[0]->DESCRIPCION."<br>";
echo $infNoticia[0]->FECHA."<br>";*/
?>