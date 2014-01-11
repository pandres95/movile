<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12">
            <h1>Envio de SMS</h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="glyphicon glyphicon-send"></i>
                    SMS
                </li>
            </ol>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        
        <form id="smsform" name="smsform" class="form-horizontal panel panel-info">
            
            <div class="panel-heading">
                <div class="form-group col-xs-12">
                    
                    <label for="sms" >
                        <input type="radio" name="send_choice" value="sms" checked> Enviar mensaje SMS
                    </label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="fa fa-envelope fa-2x"></span>
                        </span>
                        <textarea class="form-control sms" name="sms" placeholder="Ingrese su mensaje aquí"></textarea>
                    </div>                   
                </div>
                <div class="col-xs-12 form-group">
                    <label for="sms" >
                        <input type="radio" name="send_choice" value="survey" > Enviar encuesta
                    </label>
                    <select id="survey" name="survey" class="form-control survey" style="margin-top: 10px;" disabled>
                        <option disabled selected>Escoger Encuesta</option>
                        <option disabled>-------------------------------</option>
                        <?php foreach($data as $key => $value): ?>
                        <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?></option>
                        <?php endforeach; ?>
                    </select> 
                </div>
                <div class="col-xs-12 form-group">
                    <input type="file" name="archivoPlano" class="col-xs-6 form-control" style="margin-top: 10px;">
                </div>
                <div class="col-xs-12 messages">
                </div>
                <div class="col-xs-12 form-group">
                    <span class="enviosms pull-right">
                        <input type="sumbit" class="btn btn-danger btn-lg" style="margin-top: 10px;" value="Enviar SMS">
                    </span>
                </div>
            </div>
            
        </form>
        
    </div>
    
</div><!-- /#page-wrapper -->

<script>
    
    $(function() {
        
        var choice = 'sms', sur = 1;
        
        $('input[name="send_choice"]').on('click', function() {
            var x = $(this);
            choice = x.attr('value');
            switch(choice){
                case 'sms':
                    $('textarea[name="sms"]').prop("disabled", false);
                    $('select[name="survey"]').prop("disabled", true);
                    break;
                case 'survey':
                    $('textarea[name="sms"]').prop("disabled", true);
                    $('select[name="survey"]').prop("disabled", false);
                    break;
                default:
                    break;
            }
        });
        
        $('.enviosms').on('click', function(event){
            
            function showMessage(message){
                $(".messages").html("").show().html(message);
            }
            
            function hideMessage() {
                $(".messages").html("").hide();
            }
            
            
            var $data = new FormData($('form[name=smsform]')[0]);         
            if(choice === 'sms'){
                $data.append('text', $('.sms').val());
            } else {
                if($('#survey option:selected').val() == null){
                    message = $("<span class='error'>Por favor seleccione una encuesta.</span>");
                    showMessage(message);
                    return;
                } else {
                    $data.append('survey', $('#survey option:selected').val());
                }
            }
            
            console.log($data);
            
            var btn = $(this);
            btn.prop('disabled', true);
            
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
                    message = $("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Iniciando la subida de números. Por favor espere...</div>");
                    showMessage(message);
                },
                //una vez finalizado correctamente
                success: function(data){
                    var jres = JSON.parse(data);
                    btn.prop('disabled', false);
                    if(jres.status){
                        console.log(jres);
                        hideMessage();
                        $('#smsform')[0].reset();
                    } else {
                        message = $("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error</strong> " + jres.error + ".</div>");
                        showMessage(message);
                    }
                },
                //si ha ocurrido un error
                error: function(e){
                    message = $("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error</strong> " + e + "</div>");
                    showMessage(message);
                }
            });
            
        });
        
    });
    
</script>
