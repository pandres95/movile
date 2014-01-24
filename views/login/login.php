<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SMS Managment</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/movile/xhtml/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px;
      }
      .container {
        width: 300px;
      }

    </style>

</head>
<body>
  <div class="container">
    <div class="content">
      <div class="row">
        <div class="login-form">
          <h2>Movile</h2>
          <form action="<?= core::getURI() ?>/login/auth" method="post">
            <fieldset>
              <div class="clearfix">
                <input type="text" placeholder="Username" name="user" class="form-control">
              </div>
              <div class="clearfix" style="margin-top:10px; margin-bottom:10px;">
                <input type="password" placeholder="Password" name="pass" class="form-control">
              </div>
              <button class="form-control btn btn-primary" type="submit">Acceder</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div> <!-- /container -->
</body>
</html>