<div id="page-wrapper">

    <div class="row">
        <div class="jumbotron">
            <h1>
                Informes
                <small>SMS Correctos</small>
                <span class="label label-info pull-right"><?= $data['num'] ?></span>
            </h1>
        </div>
    </div>
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <i class="glyphicon glyphicon-ok"></i>
                <a href="<?= core::getURI() ?>/informe">Informes</a>
            </li>
            <li class="active">
                SMS Correctos
            </li>
        </ol>
    </div><!-- /.row -->

    <div class="row" style="margin-bottom: +1vw;" >
        <form class="pull-right form-inline" role="form">
            <div class="form-group">
                <input name="searchval" class="form-control" type="text" placeholder="Filtrar por celular">
            </div>
            <button id="btnSearch" type="button" class="btn btn-info">Buscar</button>
        </form>
    </div>

    <div class="row">
        <table id="resTable" class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Celular
                    </th>
                    <th>
                        Mensaje
                    </th>
                    <th>
                        Fecha de envío
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="row" style="text-align: center;">
        <div id="paginator"></div>
    </div>


</div><!-- /#page-wrapper -->

<script>

    $(function() {

        function reload(e, originalevent, type, page) {

            var filterval = $('input[name=searchval]').val()
            var filter = '';

            if(filterval != ''){
                filter = "&filtro=celular&valor=" + filterval;
            }

            var $url = "<?= core::getURI() ?>/informe/p_smsCorrectos/" + page + filter;

            $.ajax({
                url: $url,
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    $('#resTable tbody').html("");

                    var res = data.resultados;

                    for(item in res){

                        var detUrl = '', icon = '', action = null;

                        item = res[item];
                        switch(item.tipo){
                            case "SENT":
                                icon = 'envelope'
                                break;
                            case "SURV":
                                detUrl = "<?= core::getURI() ?>/encuesta/detalle/" + item.id;
                                icon = 'bar-chart-o'
                                break;
                        }

                        switch(item.tipo){
                            case "SENT":
                            case "FAIL":
                                action = $("<span></span>");
                                break;
                            case "SURV":
                                action = $("<a></a>")
                                .attr('href', detUrl)
                        }

                        action.addClass('fa fa-' + icon);


                        $('#resTable tbody')
                        .append(
                            $("<tr></tr>")
                            .append(
                                $("<td></td>")
                                .html(item.celular)
                            )
                            .append(
                                $("<td></td>")
                                .html(item.mensaje)
                            )
                            .append(
                                $("<td></td>")
                                .html(item.fecha)
                            )
                            .append(
                                $("<td></td>")
                                .append(
                                    $(action)
                                )
                            )
                        );

                    }


                    var options = {
                        totalPages : data.num_paginas
                    };
                    $('#paginator').bootstrapPaginator(options);


                }
            });



        }

        $('#btnSearch').click(reload);

        var options = {
            currentPage: 1,
            size:'normal',
            alignment:'center',
            onPageClicked: reload
        };
        $('#paginator').bootstrapPaginator(options);

        reload();

    });

</script>
