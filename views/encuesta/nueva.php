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
                    <p>
                        <input type="button" name="addQuestion" value="Agregar Pregunta" class="btn btn-success">
                        <div class="preguntas"></div>
                    </p>
                </section>

                <h2>Respuestas</h2>
                <section>
                    <p>
                     <div class="respuestas">
                     </div>
                    </p>
                </section>

            </div>
        </div>
    </div>
</div><!-- /#page-wrapper -->