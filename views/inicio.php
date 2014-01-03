<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Tablero de Mando</li>
            </ol>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p id="sent_sms_number" class="announcement-heading"></p>
                            <p class="announcement-text">SMS enviados</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p id="correct_sms_number" class="announcement-heading"></p>
                            <p class="announcement-text">SMS aceptado</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p id="error_sms_number" class="announcement-heading"></p>
                            <p class="announcement-text">Errores</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p id="surveys_number" class="announcement-heading"></p>
                            <p class="announcement-text">Encuestas</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Información Geolocalizada</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Envio segun regiones</h3>
                </div>
                <div class="panel-body">
                    <div id="morris-chart-donut"></div>
                    <div class="text-right">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o"></i> Actividades Recientes</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <span class="badge"></span>
                            <i class="fa fa-calendar"></i> 
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="badge"></span>
                            <i class="fa fa-comment"></i> 
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="badge"></span>
                            <i class="fa fa-truck"></i> 
                        </a>
                    </div>
                    <div class="text-right">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money"></i> Ultimas encuestas</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        
                    </div>
                    <div class="text-right">
                        
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->s
<script type="text/javascript">
    
    $.post('info/smstotales', function(data) {
        $('#sent_sms_number').text(data);
    });
    $.post('info/smscorrectos', function(data) {
        $('#correct_sms_number').text(data);
    });
    $.post('info/smsfallidos', function(data) {
        $('#error_sms_number').text(data);
    });
    $.post('info/numeroencuestas', function(data){
        $('#surveys_number').text(data);
    });
    
</script>