</div><!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="/movile/xhtml/js/bootstrap.js"></script>
<!-- Page Specific Plugins -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
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
</body>
</html>
