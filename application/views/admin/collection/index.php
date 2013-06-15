<section>
    <h2>Коллекции</h2>
    <div><?php echo anchor('admin/collection/edit', '<i class="icon-plus"></i> Добавить новую группу товаров'); ?></div>
    <div><?php echo anchor('admin/collection/order', '<i class="icon-move"></i> Сортировать список'); ?></div>
    <table class="table table-striped" id="dragndrop">
        <thead>
            <tr>
                <th>Название</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>

<?php if(count($collections)): foreach($collections as $collection): ?>
        <tr>
            <td><?=anchor('admin/collection/edit/' . $collection->id, $collection->title); ?></td>
            <td><?=btn_edit('admin/collection/edit/' . $collection->id); ?></td>
            <td><?=btn_delete('admin/collection/delete/' . $collection->id); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
            <td colspan="3">Коллекции не найдены</td>
        </tr>
<?php endif; ?>
        </tbody>
    </table>
</section>