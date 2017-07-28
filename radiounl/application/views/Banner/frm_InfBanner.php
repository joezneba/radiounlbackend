<?php
    if ($this->session->flashdata('error')) {
        echo "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>";
        echo $this->session->flashdata('error') . '</div>';
    }
    ?>
<?php
//Variables 

$FOTO = array(
    'id' => 'Foto',
    'name' => 'Foto',
    'size' => '15',
    'value' => set_value('foto')
);
?>
<!-- desactiva los campos y los activa al presionar edit-->
<script>
    $(document).ready(function () {
        $('#editar').on('click', function () {
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
                <h1>BANNER</h1>
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
				<?php echo form_open_multipart('banner/modificarBanner/' . $infBanner[0]->IDBANNER, 'class="form-horizontal"'); ?>
                    <div class="input-group">
                    	<label for="Estatus" class=" control-label">BANNER 1 </label>
                    </div>
                    <div class="table-responsive">
                		<?php echo form_upload($FOTO); ?>
                    </div>
                    <div>
                    	<img  src= "<?php echo base_url() . $infBanner[0]->FOTO; ?>" style="width: 300px; height: 250px;"data-holder-rendered="true" alt= "140x140"  class= "img-thumbnail" >
                    </div>
                    <div>
                    	<button type="submit" class="btn btn-primary" id="guardarF" name="guardarF" >Cambiar Banner</button> 
                    </div>
                <?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>


<?php
/*echo $infNoticia[0]->TITULO."<br>";
echo $infNoticia[0]->DESCRIPCION."<br>";
echo $infNoticia[0]->FECHA."<br>";*/
?>