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
                    <i class="fa fa-bar-chart-o"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>            
</table>