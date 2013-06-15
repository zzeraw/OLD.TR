<section>
    <h2>Цвета</h2>
    <div><?php echo anchor('admin/color/edit', '<i class="icon-plus"></i> Добавить новый цвет'); ?></div>
    <div><?php echo anchor('admin/color/order', '<i class="icon-move"></i> Сортировать список'); ?></div>
    <table class="table table-striped" id="dragndrop">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>

<?php if(count($colors)): foreach($colors as $color): ?>
        <tr>
            <td><img width="50" src="<?=site_url('uploads/colors/' . $color->filename)?>" alt=""></td>
            <td><?=anchor('admin/color/edit/' . $color->id, $color->title); ?></td>
            <td><?=btn_edit('admin/color/edit/' . $color->id); ?></td>
            <td><?=btn_delete('admin/color/delete/' . $color->id); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
            <td colspan="3">Цвета не найдены</td>
        </tr>
<?php endif; ?>
        </tbody>
    </table>
</section>