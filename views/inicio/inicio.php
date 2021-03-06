<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i>
                    Tablero de Mando
                </li>
            </ol>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        <a href="<?= core::getURI() ?>/informe/sms_enviados">
            <div class="col-lg-3">
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
        <a href="<?= core::getURI() ?>/informe/sms_correctos">
            <div class="col-lg-3">
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
        </a>
        <a href="<?= core::getURI() ?>/informe/sms_fallidos">
            <div class="col-lg-3">
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
        </a>
        <div class="col-lg-3">
            <a href="<?= core::getURI() ?>/encuesta">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-list-alt fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                                <p class="announcement-heading"><?php echo $data['encuestas'] ?></p>
                                <p class="announcement-text">Encuestas</p>
                            </div>
                        </div>
                    </div>    
                </div>
            </a>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-bar-chart-o"></i>
                        Información Geolocalizada
                    </h3>
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
                    <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Respuestas segun regiones</h3>
                </div>
                <div class="panel-body">
                    <div id="morris-chart-donut"></div>
                    <div class="text-right">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-list-alt"></i>
                        Últimas encuestas agregadas
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php foreach($data['ultimas_encuestas'] as $k => $v): ?>
                        <a href="<?= core::getURI() ?>/encuesta/detalle/<?= $v['id'] ?>" class="list-group-item">
                            <span class="badge"></span>
                            <i class="fa fa-list-alt"></i>
                            <?= $v['nombre'] ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-right">
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.row -->
</div><!-- /#page-wrapper -->

<!-- Page Specific CSS -->
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
<!--<script src="/movile/xhtml/js/morris/chart-data-morris.js"></script>-->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- Page Specific Plugins -->
<script src="//cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="/movile/xhtml/js/tablesorter/jquery.tablesorter.js"></script>
<script src="/movile/xhtml/js/tablesorter/tables.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        
        var map = L.map('map').setView([4.5,-73], 5);
        
        L.tileLayer('http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
        }).addTo(map);
        
        var smsCuenta = JSON.parse('<?php echo $data['sms_enviados_mun']; ?>');
        
        for(obj in smsCuenta){
            obj = smsCuenta[obj];
            L.marker([obj.latitud,obj.longitud]).addTo(map)
            .bindPopup("<b>" + obj.municipio + "</b><br />" + obj.cuenta + " SMS Enviados.");
        }
        
        var top10SMS = <?php echo $data['respuestas_por_deptos']; ?>;
        
        Morris.Donut({
            element: 'morris-chart-donut',
            data: top10SMS,
            formatter: function (y) { return y + "%" ;}
        });
        
    });
    
</script>

