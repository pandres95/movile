<div id="page-wrapper">
    
    <div class="row">
        <div class="jumbotron">
            <h1>
                Encuestas
                <span class="label label-info pull-right"><?= $data['num'] ?></span>
            </h1>
        </div>
    </div>
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <i class="glyphicon glyphicon-list"></i> 
                <a href="">Encuestas</a>
            </li>
            <li class="active">
                Listado de Encuestas
            </li>
        </ol>
    </div><!-- /.row -->
    
    <div class="row" style="margin-bottom: +1vw;" >
        <form class="pull-right form-inline" role="form">
            <div class="form-group">
                <input name="searchval" class="form-control" type="text" placeholder="Filtrar por nombre">
            </div>
            <button id="btnSearch" type="button" class="btn btn-info">Buscar</button>
        </form>
    </div>
    
    <div id="resTable" class="row">
    </div>
    
    <div class="row" style="text-align: center;">
        <div id="paginator"></div>
    </div>
    
    
</div><!-- /#page-wrapper -->

<script>
    
    $(function() {
        
        function reloadFiltered() {
            localStorage.setItem('valor', $('input[name=searchval]').val());
            $( "#resTable" ).load( "<?= core::getURI() ?>/encuesta/pagLista&filtro=nombre&valor=" + localStorage.getItem('valor')); 
            var options = {
                currentPage: 3,
                totalPages: 10,
                size:'normal',
                alignment:'center'
            };
        }
        
        $('#btnSearch').click(reloadFiltered);
        
        localStorage.clear();
        $( "#resTable" ).load( "<?= core::getURI() ?>/encuesta/pagLista");
        
        var options = {
            currentPage: 3,
            totalPages: 10,
            size:'normal',
            alignment:'center'
        };
        $('#paginator').bootstrapPaginator(options);
        
    });
    
</script>