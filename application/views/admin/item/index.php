<section>
    <h2>Товары</h2>
    <?php
        $errors = $this->session->flashdata('error');
        if ($errors): ?>
            <div class="alert alert-error">
                <h4>Что-то пошло не так...</h4>
                <?php foreach ($errors as $error): ?>
                    <?=$error;?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <div><?php echo anchor('admin/item/edit', '<i class="icon-plus"></i> Добавить новый товар'); ?></div>
    <div><?php echo anchor('admin/item/order', '<i class="icon-move"></i> Сортировать список'); ?></div>
    <table class="table table-striped" id="dragndrop">
        <thead>
            <tr>
                <td></td>
                <th>Название</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>

<?php if(count($items)): foreach($items as $item): ?>
        <tr>
            <td><?php if (isset($images[$item->id])): ?>
                    <img width=60 src="<?=site_url('uploads/' . $images[$item->id])?>" alt=""></td>
                <?php endif; ?>
            <td><?=anchor('admin/item/edit/' . $item->id, $item->title); ?></td>
            <td><?=btn_edit('admin/item/edit/' . $item->id); ?></td>
            <td><?=btn_delete('admin/item/delete/' . $item->id); ?></td>
        </tr>
<?php endforeach; ?>
<?php else: ?>
        <tr>
            <td colspan="3">Товары не найдены</td>
        </tr>
<?php endif; ?>
        </tbody>
    </table>
</section>