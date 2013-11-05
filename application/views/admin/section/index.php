<section>
    <h2>Раделы</h2>
    <div><?php echo anchor('admin/section/edit', '<i class="icon-plus"></i> Добавить новый раздел'); ?></div>
    <div><?php echo anchor('admin/section/order', '<i class="icon-move"></i> Сортировать список'); ?></div>
    <table class="table table-striped" id="dragndrop">
        <thead>
            <tr>
                <th>Раздел</th>
                <!-- <th></th> -->
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>

<?php if(count($sections)): foreach($sections as $section): ?>
        <tr>
            <td><?=anchor('admin/section/edit/' . $section->id, $section->title); ?></td>
            <!-- <td><?=$section->slug;?></td> -->
            <td><?=btn_edit('admin/section/edit/' . $section->id); ?></td>
            <td><?=btn_delete('admin/section/delete/' . $section->id); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
            <td colspan="3">Разделы не найдены</td>
        </tr>
<?php endif; ?>
        </tbody>
    </table>
</section>