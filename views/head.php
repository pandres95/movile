<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <title>Panel de Control - SMS Managment</title>
        
        <!-- Bootstrap core CSS -->
        <link href="/movile/xhtml/css/bootstrap.css" rel="stylesheet">
        
        <!-- Add custom CSS here -->
        <link href="/movile/xhtml/css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="/movile/xhtml/font-awesome/css/font-awesome.min.css">
        <!-- Page Specific CSS -->
        <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
        <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
        <!--[if lte IE 8]>
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
<![endif]-->
        <!-- jQuery javascript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="/movile/xhtml/js/bootstrap.js"></script>
        <!-- Page Specific Plugins -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        
        <style type="text/css">
            #map { height: 250px; }
        </style>
        
    </head>
    
    <body>
        
        <div id="wrapper">
            
            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Movile</a>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <?php
foreach ($data['menu'] as $key => $value) {
    echo '<li><a href="/movile/'.$value['url'].'"><i class="fa fa-pencil-square-o"></i>  '.$value['nombre'].'</a></li>';
}
                        ?>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown messages-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Mensajes <span id="new_messages_number" class="badge"></span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">7 Mensajes Nuevos</li>
                                <li class="message-preview unread">
                                    <a href="#">
                                        <span class="name">Andrea Ramirez:</span>
                                        <span class="message">Hola, te recuerdo el envio de las encuestas...</span>
                                        <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <!--<li class="message-preview">
<a href="#">
<span class="name">Andrea Ramirez:</span>
<span class="message">Hola, te recuerdo el envio de las encuestas...</span>
<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
</a>
</li>
<li class="divider"></li>-->
                                <li><a href="#">Bandeja de Mensajes <span class="badge">7</span></a></li>
                            </ul>
                        </li>
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                                <?php echo $data['nombre']; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>
                                <li><a href="#"><i class="fa fa-gear"></i> Opciones</a></li>
                                <li class="divider"></li>
                                <li><a href="login/logout"><i class="fa fa-power-off"></i> Salir del sistema</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            