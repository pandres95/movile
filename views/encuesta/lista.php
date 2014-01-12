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
    
    <div class="row">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Nombre
                    </th>
                    <th></th>
                </tr>
                <?php foreach($data['encuestas'] as $key => $val): ?>
                <tr>
                    <td>
                        <?= $val['id'] ?>
                    </td>
                    <td>
                        <?= $val['nombre'] ?>
                    </td>
                    <td>
                        <a href="<?= core::getURI() ?>/encuesta/detalle/<?= $val['id'] ?>">
                            <i class="fa fa-cogs"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>            
        </table>        
    </div>
    
</div><!-- /#page-wrapper -->