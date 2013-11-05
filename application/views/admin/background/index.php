<section>
    <h2>Фоновые изображения</h2>
    <div><?php echo anchor('admin/background/edit', '<i class="icon-plus"></i> Добавить новый фон'); ?></div>
    <div><?php echo anchor('admin/background/order', '<i class="icon-move"></i> Сортировать список'); ?></div>
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

<?php if(count($backgrounds)): foreach($backgrounds as $background): ?>
        <tr>
            <td><img width="50" src="<?=site_url('uploads/backgrounds/' . $background->filename)?>" alt=""></td>
            <td><?=anchor('admin/background/edit/' . $background->id, $background->title); ?></td>
            <td><?=btn_edit('admin/background/edit/' . $background->id); ?></td>
            <td><?=btn_delete('admin/background/delete/' . $background->id); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
            <td colspan="3">Фоновые изображения не найдены</td>
        </tr>
<?php endif; ?>
        </tbody>
    </table>
</section>