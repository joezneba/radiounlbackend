
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <span class="glyphicon glyphicon-list-alt"></span> BANNER
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i> <a href="<?php echo base_url() ?>index.php/login/page_Admin">Inicio</a>
                </li>
                <li class="active">
                    <i class="fa fa-list-alt"></i> BANNER
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
            </div>
        </div>
    </div>

    <br/>
    <div>
        <div class="">
            <table id="Banner" class="pretty">   
                <thead>
                    <tr>
                    <th></th>
                    <th>BANNER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // se analiz si existen elemnetos se presentan caso contrario pasa al else y presenta que no existe inormacion
                    if ($lista) {
                        foreach ($lista as $row) {
                        echo '<tr>';
                        echo '<td>';
                            ?>
                            <a href="<?php echo base_url(); ?>index.php/banner/eliminarBanner/<?= $row['IDBANNER'] ?>" type="button" onclick='if (!confirm("Está seguro de eliminar "))
                                return false' title="Eliminar Banner" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                            <?php
                            $cadena="BANNER";
                            echo '</td>';
                            echo '<td>' . anchor('banner/infBanner/' . $row['IDBANNER'],$cadena ) . '</td>';
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
        $('#Banner').dataTable({
            "scrollX": true
        });
    });
</script>
