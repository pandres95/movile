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
                            <p class="announcement-heading"><?php echo $data['sms']['enviados'] ?></p>
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
                            <p class="announcement-heading"><?php echo $data['sms']['correctos'] ?></p>
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
                            <p class="announcement-heading"><?php echo $data['sms']['fallidos'] ?></p>
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
                            <p class="announcement-heading"><?php echo $data['encuestas'] ?></p>
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
</div><!-- /#page-wrapper -->

<!-- Page Specific Plugins -->
<script src="//cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="/movile/xhtml/js/morris/chart-data-morris.js"></script>
<script src="/movile/xhtml/js/tablesorter/jquery.tablesorter.js"></script>
<script src="/movile/xhtml/js/tablesorter/tables.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        
        $('.enviosms').on('click',function(){
            var $data = new FormData($('form[name=smsform]')[0]);
            $data.append('action','sendSMS');
            $data.append('text',$('.sms').val());
            console.log($data);
            var btn = $(this);
            btn.attr('disabled','disabled');
            /*        $.post('/movile/enviosms/enviarsms',$data,function(data){
            console.log(data);
            var jres = JSON.parse(data);
                if(jres.status){
                  console.log('Yeahhhh!!!');
                  btn.removeAttr('disabled');
                }
        });*/
            function showMessage(message){
                $(".messages").html("").show();
                $(".messages").html(message);
            }
            
            $.ajax({
                url: '/movile/enviosms/enviarsms',  
                type: 'POST',
                // Form data
                //datos del formulario
                data: $data,
                //necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
                //mientras enviamos el archivo
                beforeSend: function(){
                    message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                    showMessage(message)         
                },
                //una vez finalizado correctamente
                success: function(data){
                    var jres = JSON.parse(data);
                    if(jres.status){
                        console.log('Yeahhhh!!!');
                        btn.removeAttr('disabled');
                    }
                    
                },
                //si ha ocurrido un error
                error: function(){
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                    showMessage(message);
                }
            });        
            
            
        });
        
        var map = L.map('map').setView([10.46587,-73.25048], 13);
        
        L.tileLayer('http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
        }).addTo(map);
        
        
        L.marker([10.46587,-73.25048]).addTo(map)
        .bindPopup("<b>Valledupar</b><br /> 80 SMS Enviados.").openPopup();
        
    });
    
    
    
    
</script>
