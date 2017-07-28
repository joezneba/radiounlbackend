<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <span class="glyphicon glyphicon-indent-left"></span> Información
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i> Inicio
            </li>
            <li>
                <a id="cUS" type="button" href="<?php echo base_url(); ?>index.php/noticia/index" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span>     Crear Noticia</a>
            </li>
            <li>
                <a id="cUS" type="button" href="<?php echo base_url(); ?>index.php/programa/index" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span>     Crear Programa</a>
            </li>
            <li>
                <a id="cUS" type="button" href="<?php echo base_url(); ?>index.php/programa/index" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span>     Crear Programa Grabado</a>
            </li>
        </ol>
    </div>
    <div class="col-lg-12">
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p class="p"><i class="fa fa-info-circle"></i> <strong>RADIO UNIVERSITARIA </strong><br>
                Radio Universitaria 98.5 es un medio de comunicación público de la Universidad Nacional de Loja, para comunicarse con la comunidad a través de la coordinación, cooperación, consulta, intercambio y promoción del arte, la ciencia, la cultura y el desarrollo de Loja y la Región Sur.</p>  
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-exclamation fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> Noticias </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url(); ?>index.php/noticia/listaNoticias">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalles</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            <?php
                            //////////php///////////
                            ?>
                        </div>
                        <div class="huge">Parrilla</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url(); ?>index.php/programa/listaProgramas">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalles</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            <?php
                            ////////////////
                            ?>
                        </div>
                        <div class="huge">Programas Grabados</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url(); ?>index.php/programagrabado/listaProgramasGrabados">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalles</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

