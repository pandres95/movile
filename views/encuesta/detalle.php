<div id="page-wrapper">
    
    <div class="row">
        <div class="jumbotron">
            <h1>
                Encuestas
                <small><?= $data['nombre'] ?></small>
            </h1>
        </div>
    </div>
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <i class="glyphicon glyphicon-list"></i> 
                <a href="<?= core::getURI()?>/encuesta/">
                    Encuestas
                </a>
            </li>
            <li>
                <a href="<?= core::getURI()?>/encuesta/">
                    Listado de encuestas
                </a>
            </li>
            <li class="active">
                <?= $data['nombre'] ?>
            </li>
        </ol>
    </div><!-- /.row -->
    
    <?php foreach($data['preguntas'] as $key => $val): ?>
    <div class="row">
        <div class="col-lg-12">
            <h4><?= $key +1 . ". " . $val['texto'] ?></h4>
            <ol style="">
                <?php foreach($data['respuestas'][$key] as $k => $v): ?>
                <li><?= $v['texto'] ?></li>
                <?php endforeach; ?>
            </ol>    
        </div>
    </div>
    <?php endforeach; ?>
    
</div><!-- /#page-wrapper -->