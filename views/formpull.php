<div id="page-wrapper">
    
    <div class="row">
        <div class="col-lg-12">
            <h1>Envio de SMS <small>Encuestas.</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> SMS</li>
            </ol>
        </div>
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        
                        
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <fieldset>
                            <!-- Text input-->
                            <div class="control-group">
                                <label class="control-label" for="textinput">Titulo de la Encuesta</label>
                                <div class="controls">
                                    <input id="textinput" name="textinput" type="text" placeholder="Titulo de la encuesta" class="form-control">
                                    <p class="help-block">help</p>
                                </div>
                            </div>
                            
                            <!-- Text input-->
                            <div class="control-group">
                                <label class="control-label" for="textinput">Pregunta</label>
                                <div class="controls">
                                    <input id="textinput" name="textinput" type="text" placeholder="Pregunta a enviar" class="form-control">
                                    <p class="help-block">help</p>
                                </div>
                            </div>
                            
                            <!-- Text input-->
                            <div class="control-group">
                                <label class="control-label" for="textinput">Respuestas Validas</label>
                                <div class="controls">
                                    <select name="responses" class="form-control"> 
                                        <option selected=selected>Escoger</option>
                                        <option val="1">Si o No</option>
                                        <option val="2">Si, No, No Sabe</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <div class="control-group" style="margin-top:10px;">
                                <div class="controls">
                                    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Enviar Encuesta</button>
                                </div>
                            </div>
                            
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- /#page-wrapper -->