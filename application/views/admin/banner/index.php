<section>
    <h2>Баннеры</h2>
    <div><?php echo anchor('admin/banner/edit', '<i class="icon-plus"></i> Добавить новый баннер'); ?></div>
    <div><?php echo anchor('admin/banner/order', '<i class="icon-move"></i> Сортировать список'); ?></div>
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

<?php if(count($banners)): foreach($banners as $banner): ?>
        <tr>
            <td><img width="50" src="<?=site_url('uploads/banners/' . $banner->filename)?>" alt=""></td>
            <td><?=anchor('admin/banner/edit/' . $banner->id, $banner->title); ?></td>
            <td><?=btn_edit('admin/banner/edit/' . $banner->id); ?></td>
            <td><?=btn_delete('admin/banner/delete/' . $banner->id); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
            <td colspan="3">Баннеры не найдены</td>
        </tr>
<?php endif; ?>
        </tbody>
    </table>
</section>