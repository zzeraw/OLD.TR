<section>
    <h2>Группы товаров</h2>
    <div><?php echo anchor('admin/group/edit', '<i class="icon-plus"></i> Добавить новую группу товаров'); ?></div>
    <div><?php echo anchor('admin/group/order', '<i class="icon-move"></i> Сортировать список'); ?></div>
    <table class="table table-striped" id="dragndrop">
        <thead>
            <tr>
                <th>Название</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>

<?php if(count($groups)): foreach($groups as $group): ?>
        <tr>
            <td><?=anchor('admin/group/edit/' . $group->id, $group->title); ?></td>
            <td><?=btn_edit('admin/group/edit/' . $group->id); ?></td>
            <td><?=btn_delete('admin/group/delete/' . $group->id); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
            <td colspan="3">Группы товаров не найдены</td>
        </tr>
<?php endif; ?>
        </tbody>
    </table>
</section>