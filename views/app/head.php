<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <title>Panel de Control - SMS Managment</title>
        
        <!-- Bootstrap core CSS -->
        <link href="/movile/xhtml/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Add custom CSS here -->
        <link href="/movile/xhtml/css/main.css" rel="stylesheet">
        <link href="/movile/xhtml/css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="/movile/xhtml/font-awesome/css/font-awesome.min.css">
    
        <!-- jQuery javascript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="/movile/xhtml/js/vendor/bootstrap.js"></script>
        <script src="/movile/xhtml/js/paginator/bootstrap-paginator.js" ></script>
        
        <script>
            $(function(){
                
                function buildMenu(menu) {
                    
                    for(item in menu){
                        item = menu[item];
                        
                        var it = $("<li></li>")
                            .attr("id", "menu" + item.id)
                            .append(
                                $("<a></a>")
                                .attr("id", "li" + item.id)
                                .attr("href", "<?= core::getURI() ?>/" + item.url)
                                .append(
                                    $('<i' +
                                      (item.icon != null? ' class="glyphicon glyphicon-' + item.icon + ' glyphicon" ':'')  +
                                      '></i> ' + item.nombre
                                     )
                                )
                                .append(" " + item.nombre)
                                
                            );
                        
                        if(item.parent == null){
                            $("#menu_nav").append(it);
                        } else {
                                                        
                            var pMenu = $("#li" + item.parent), pMenuC = pMenu.clone();
                            
                            if(!$('#menu' + item.parent).hasClass("dropdown")){
                                $("#menu" + item.parent).addClass("dropdown")
                                .html(
                                    $(pMenu)
                                    .attr("id", "li" + item.parent + "t")
                                    .attr("href", "#")
                                    .addClass("dropdown-toggle")
                                    .attr("data-toggle", "dropdown")
                                )
                                .append(
                                    $("<ul class='dropdown-menu'></ul>")
                                    .append($("<li></li>")
                                            .attr("id", "menu" + item.parent + "t")
                                            .append(pMenuC)
                                           )
                                    .append(it)
                                );
                            } else {
                                var x = $("#menu" + item.parent)
                                $("ul", x).
                                append(it);
                            }
                        }
                        
                    }
                    
                }
                
                $.ajax({
                    url: "<?= core::getURI() ?>/app/header_items",
                    type: "POST",
                    success: function(data){
                        $("#uname").html(data.nombre);
                        buildMenu(data.menu);
                    }
                });
                
            });
        </script>
        
        <style type="text/css">
            #map { height: 250px; }
        </style>
        
    </head>
    
    <body>
        
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
                <a class="navbar-brand" href="<?php echo core::getURI(); ?>">Movile</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                
                <ul id="menu_nav" class="nav navbar-nav side-nav">
                </ul>
                
                <ul class="nav navbar-nav navbar-right navbar-user">
                    
                    <li class="dropdown messages-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            Mensajes
                            <span id="new_messages_number" class="badge"></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">7 Mensajes Nuevos</li>
                            <li class="message-preview unread">
                                <a href="#">
                                    <span class="name">Andrea Ramirez:</span>
                                    <span class="message">Hola, te recuerdo el envio de las encuestas...</span>
                                    <span class="time">
                                        <i class="fa fa-clock-o"></i>
                                        4:34 PM
                                    </span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">Bandeja de Mensajes <span class="badge">7</span></a>
                            </li>
                        </ul>
                        
                    </li>
                    
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span id="uname"></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-user"></i> 
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-gear"></i>
                                    Opciones
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo core::getURI(); ?>/login/logout">
                                    <i class="fa fa-power-off"></i>
                                    Salir del sistema
                                </a>
                            </li>
                        </ul>                        
                    </li>
                    
                </ul>
                
            </div>
            <!-- /.navbar-collapse -->
            
        </nav>
        
        <div id="wrapper">