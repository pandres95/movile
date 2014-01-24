<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12">
            <h1>Encuestas <small>Nueva encuesta.</small></h1>
            <ol class="breadcrumb">
                
                <li><i class="fa fa-list"></i> <a href="../encuesta">Encuestas</a></li>
                <li class="active">Nueva encuesta</li>
            </ol>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <script>
                $(function ()
                  {
                      
                      var np = 0, nrp = 0, cp = 1;
                      
                      $(document).on('click','input[name=addQuestion]',function(){
                          np++;
                          $('.preguntas').append('<input type="text" name="pregunta_'+np+'" class="form-control cp">')
                          $('.respuestas').append('<input type="button" name="addAnswer" id="'+np+'" value="Agregar Respuestas Pregunta '+np+'" class="btn btn-success"><div></div>');
                      });
                      
                      $(document).on('click','input[name=addAnswer]',function(){
                          var idPregunta = $(this).attr('id');
                          if(cp == idPregunta){
                              nrp++;    
                          }else{
                              nrp = 1;
                              cp = idPregunta;  
                          }
                          
                          $(this).next('div').append('<input type="text" name="respuesa_'+nrp+'_pre_'+idPregunta+'" class="form-control cp">')
                      });
                      
                      $("#wizard").steps({
                          headerTag: "h2",
                          bodyTag: "section",
                          transitionEffect: "slideLeft",
                          onFinished: function (event, currentIndex) { 
                              var preguntas = $('.preguntas input').frm2obj();
                              console.log(preguntas);
                              var respuestas = $('.respuestas div input').frm2obj();
                              console.log(respuestas);
                          },
                          /* Labels */
                          labels: {
                              current: "current step:",
                              pagination: "Pagination",
                              finish: "Fin",
                              next: "Siguiente",
                              previous: "Anterior",
                              loading: "Cargando ..."
                          }
                      });
                  });
            </script>
            
            <div id="wizard">
                <h2>Nombre de Encuesta</h2>
                <section>
                    <p><input type="text" class="form-control" name="nombre" placeholder="Nombre de la Encuesta."></p>
                </section>
                
                <h2>Preguntas</h2>
                <section>
                    <input type="button" name="addQuestion" value="Agregar Pregunta" class="btn btn-success">
                    <div class="preguntas"></div>
                </section>
                
                <h2>Respuestas</h2>
                <section>
                    <div class="respuestas">
                    </div>
                </section>
                
            </div>
            
            
        </div>
    </div>
</div><!-- /#page-wrapper -->