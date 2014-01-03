     <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Envio de SMS <small>Masivos.</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> SMS</li>
            </ol>
          </div>
        </div><!-- /.row -->

       <div class="row">
       <form enctype="multipart/form-data" name="smsform">
          <div class="col-lg-6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-12 form-group" style="height:74px;">
                    <textarea class="col-xs-6 form-control sms" name="sms" style="height:74px;"></textarea>
                  </div>
                  <div class="col-xs-12 form-group" style="height:34px;">
                    <input type="file" name="archivoPlano" class="col-xs-6 form-control" style="margin-top: 10px;">
                  </div> 
                  <div class="col-xs-12 form-group" style="height:34px;">
                    <select class="col-xs-6 form-control" style="margin-top: 10px;">
                       <option seletected=selected>Escoger Encuesta</option>
                    </select>
                  </div>                                    
                  <div class="col-xs-12 form-group">
                  <br>
                    <p><button class="btn btn-danger btn-lg enviosms pull-right" style="margin-top: 10px;">Enviar SMS</button></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      </div><!-- /#page-wrapper -->