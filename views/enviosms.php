<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12">
            <h1>Envio de SMS <small>Masivos.</small></h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i>
                    SMS
                </li>
            </ol>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        
        <form enctype="multipart/form-data" name="smsform" role="form" class="form-horizontal panel panel-info">
            
            <div class="panel-heading">
                <div class="form-group col-xs-12">
                    <label for="sms" >
                        <input type="radio" name="send_choice" id="choose1" value="sms" checked> Enviar mensaje SMS
                    </label>
                    <textarea class="form-control sms" name="sms" placeholder="Ingrese su mensaje aquí"></textarea>
                </div>
                <div class="col-xs-12 form-group">
                    <label for="sms" >
                        <input type="radio" name="send_choice" id="choose1" value="sms" > Enviar encuesta
                    </label>
                    <select class="form-control" style="margin-top: 10px;" disabled>
                        <option disabled selected>Escoger Encuesta</option>
                        <option disabled>-------------------------------</option>
                    </select>
                </div>
                <div class="col-xs-12 form-group">
                    <input type="file" name="archivoPlano" class="col-xs-6 form-control" style="margin-top: 10px;">
                </div>
                <div class="col-xs-12 form-group">
                    <p>
                        <button class="btn btn-danger btn-lg enviosms pull-right" style="margin-top: 10px;">
                            Enviar SMS
                        </button>
                    </p>
                </div>
            </div>
            
        </form>
        
    </div>
    
</div><!-- /#page-wrapper -->


<script>
    
    $(function() {
        
        $('.enviosms').on('click', function(){
            
            var $data = new FormData($('form[name=smsform]')[0]);
            $data.append('text',$('.sms').val());
            
            console.log($data);
            
            var btn = $(this);
            btn.attr('disabled','disabled');
            
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
                    message = $("<span class='before'>Iniciando la subida de números. Por favor espere...</span>");
                    showMessage(message);
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
        
    });
    
</script>
