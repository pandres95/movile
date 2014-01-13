<div id="page-wrapper">

    <div class="row">
        <div class="jumbotron">
            <h1>
                Informes
            </h1>
        </div>
    </div>
    <div class="row">
        <ol class="breadcrumb">
            <li class="active">
                <i class="glyphicon glyphicon-book"></i>
                <a href="">Informes</a>
            </li>
        </ol>
    </div><!-- /.row -->

    <div class="row">
        <a href="<?= core::getURI() ?>/informe/sms_enviados">
            <div class="col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                                <p class="announcement-heading"><?php echo $data['sms']['enviados'] ?></p>
                                <p class="announcement-text">SMS enviados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <div class="col-lg-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo $data['sms']['correctos'] ?></p>
                            <p class="announcement-text">SMS aceptado</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo $data['sms']['fallidos'] ?></p>
                            <p class="announcement-text">Errores</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- /.row -->

</div><!-- /#page-wrapper -->
