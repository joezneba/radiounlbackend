
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-list-alt"></span> Programas Grabados
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i> <a href="<?php echo base_url() ?>index.php/login/page_Admin">Inicio</a>
                </li>
                <li class="active">
                    <i class="fa fa-list-alt"></i> Programas Grabados
                </li>
            </ol>
        </div>
    </div>
    <div id="mensaje"></div>
    <div class="col-xs-12 col-sm-6 col-md-12">

    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-12">
            <div class="form-group">
                <?php
                if ($this->session->flashdata('error')) {
                    echo "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    echo $this->session->flashdata('error') . '</div>';
                }
                ?>
                <div class="col-xs-12 col-sm-6 col-md-1">
                    <a type="button" href="<?php echo base_url(); ?>index.php/programagrabado/index" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Programa</a>   
                </div>
            </div>
        </div>
    </div>

    <br/>
    <div>
        <div class="">
            <table id="ProgramasGrabados" class="pretty">   
                <thead>
                    <tr>
                    <th></th>
                    <th>TITULO</th>
                    <th>ARCHIVO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // se analiza si existen elemnetos se presentan caso contrario pasa al else y presenta que no existe inormacion
                    if ($lista) {
                        foreach ($lista as $row) {
                        echo '<tr>';
                        echo '<td>';
                            ?>
                            <a href="<?php echo base_url(); ?>index.php/programagrabado/eliminarProGra/<?= $row['IDPROGRAMAGRABADO'] ?>" type="button" onclick='if (!confirm("Está seguro de eliminar "))
                                return false' title="Eliminar Usuario" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                            <?php
                            echo '</td>';
                            echo '<td>' . anchor('programagrabado/infProgramaGrabado/' . $row['IDPROGRAMAGRABADO'], $row['TITULO'], 'class="linkdescr"') . '</td>';
                            echo '<td>' . $row['AUDIO'] . '</td>';
                            echo '</tr>';
                        }
                    }else {
                        echo '<tr><td colspan=5><center>No Existe Informacion</center></td></tr>';
                    }
                     
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        $('#ProgramasGrabados').dataTable({
            "scrollX": true
        });
    });
</script>







<?php
/*foreach ($lista as $fila) {
    echo "TITULO: ".$fila['TITULO']."<br>";
    echo "DESCRIPCION: ".$fila['DESCRIPCION']."<br>";
    echo "FECHA: ".$fila['FECHA']."<br>";   
    ?>
    <div>
        <img  src= "<?php echo base_url() . $fila['FOTO']; ?>" style="width: 300px; height: 250px;"data-holder-rendered="true" alt= "140x140"  class= "img-thumbnail" >
    </div>
    <?php   
}
*/
?>