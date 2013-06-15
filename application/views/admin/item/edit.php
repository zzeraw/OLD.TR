
<h3><?php echo empty($item->id) ? 'Добавление нового товара' : 'Редактировать товар "' . $item->title . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('', array('class' => 'form-horizontal', 'name' => 'edit_item')); ?>

<div class="control-group">
    <label class="control-label" for="title">Название</label>
    <div class="controls">
        <?=form_input('title', set_value('title', $item->title));?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="article">Артикул</label>
    <div class="controls">
        <?php echo form_input('article', set_value('article', $item->article)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="composition">Состав</label>
    <div class="controls">
        <?php echo form_input('composition', set_value('composition', $item->composition)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="price">Цена</label>
    <div class="controls">
        <?php echo form_input('price', set_value('price', $item->price)); ?> рублей
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="body">Содержимое</label>
    <div class="controls">
        <?php echo form_textarea('body', set_value('body', $item->body), 'class="tinymce"'); ?>
    </div>
</div>


<div class="control-group catalog-colors">
    <label for="" class="control-label">Цвета</label>

    <?php if($colors[0]->id != NULL): ?>
    <?php foreach ($colors as $key => $color): ?>
        <div class="controls catalog-block catalog-color element-item" data-exist_color="<?=$color->id?>">
            <?php if ($key != 0) { ?>
                <i class="pull-right icon-remove remove-catalog-color remove-exist-color"></i>
            <?php } ?>
            <?php foreach ($colors_list as $color_item): ?>
                <?php
                    if ($color_item->id == $color->id_color) {
                        $selected_class = "color-preview-selected";
                    } else {
                        $selected_class = "";
                    }
                ?>
                <img class="color-select color-preview <?=$selected_class?>" data-color="<?=$color_item->id?>" width=30 src="<?=site_url('uploads/colors/' . $color_item->filename)?>" alt="<?=$color_item->title?>" title="<?=$color_item->title?>" />
            <?php endforeach; ?>

            <div class="control-group">
                <label for="" class="control-label">Размеры</label>
                <div class="controls">
                    <?php $sizes_str = ''; ?>
                    <?php if (isset($sizes[$color->id])) { ?>
                        <?php foreach ($sizes[$color->id] as $size):
                            $sizes_str .= $size['size'] . ', ';
                        endforeach; ?>
                    <?php } ?>
                    <?=form_input('size[' . $color->id . ']', set_value('size', $sizes_str)); ?>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Картинки</label>
                <div class="controls">
                    <?php if (isset($images[$color->id])) { ?>
                        <?php foreach ($images[$color->id] as $image): ?>
                            <div class="catalog-image-item pull-left element-item" data-image="<?=$image['id']?>">
                                <img width=80 src="<?=site_url('uploads/' . $image['thumb'])?>" /><i class="remove-exist-image close icon-remove" title="Удалить изображение"></i>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                    <?php } ?>
                </div>
                <div class="controls">
                    <div class="element-item catalog-images" data-color="<?=$color->id?>">

                    </div>
                    <button type="button" class="btn add-catalog-image-of-exist-color"><i class="icon-plus"></i> Добавить изображение</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>

</div>
<div class="control-group">
    <div class="controls">
        <button type="button" class="btn add-catalog-color"><i class="icon-plus"></i> Добавить цвет</button>
    </div>
</div>

    <script id="catalog-color-template" type="text/x-handlebars-template">
        <div class="controls catalog-block catalog-new-color element-item" data-new_color="{{new_color_counter}}">
            <i class="pull-right icon-remove remove-catalog-color remove-new-item"></i>
            <?php foreach ($colors_list as $color_key => $color_item): ?>
                <?php
                    if ($color_key == 0) {
                        $selected_class = "color-preview-selected";
                    } else {
                        $selected_class = "";
                    }
                ?>
                <img class="color-select color-preview <?=$selected_class?>" data-color="<?=$color_item->id?>" width=30 src="<?=site_url('uploads/colors/' . $color_item->filename)?>" alt="<?=$color_item->title?>" title="<?=$color_item->title?>" />
            <?php endforeach; ?>

            <div class="control-group">
                <label for="" class="control-label">Размеры</label>
                <div class="controls">
                    <?=form_input('new_size[{{new_color_counter}}]'); ?>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Картинки</label>
                <div class="controls">
                    <div class="catalog-images">

                    </div>
                    <button type="button" class="btn add-catalog-image-of-new-color"><i class="icon-plus"></i> Добавить изображение</button>
                </div>
            </div>
        </div>
    </script>

<script id="catalog-image-of-exist-color-template" type="text/x-handlebars-template">
    <div class="element-item">
        <?=form_upload('image_{{color_id}}_{{images_counter}}', '', 'data-images_counter="{{images_counter}}"'); ?> <i class="icon-remove remove-catalog-new-image remove-new-item"></i>
    </div>
</script>

<script id="catalog-image-of-new-color-template" type="text/x-handlebars-template">
    <div class="element-item">
        <?=form_upload('new_image_{{new_color_id}}_{{images_counter}}', '', 'data-images_counter="{{images_counter}}"'); ?> <i class="icon-remove remove-catalog-new-image remove-new-item"></i>
    </div>
</script>

    <div class="control-group catalog-groups">
        <label class="control-label" for="group">Группа товаров</label>
    <?php foreach ($groups as $key => $group): ?>

            <div class="controls catalog-group element-item" data-group="<?=$group->group_id?>">
                <?php echo form_dropdown('group[' . $group->group_id .']', $groups_list, $group->group_value); ?>
                <?php if ($key != 0) { ?>
                    <i class="icon-remove remove-exist-group"></i>
                <?php } ?>
            </div>

            <script id="catalog-group-template" type="text/x-handlebars-template">
                <div class="controls catalog-group element-item">
                    <?php echo form_dropdown('new_group[]', $groups_list, 0); ?>
                    <i class="icon-remove remove-catalog-group remove-new-item" ></i>
                </div>
            </script>

    <?php endforeach; ?>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="button" class="btn add-catalog-group"><i class="icon-plus"></i> Добавить группу</button>
        </div>
    </div>



<?php if(count($collections)): ?>
    <div class="control-group catalog-collections">
        <label class="control-label" for="collection">Коллекция товаров</label>
    <?php foreach ($collections as $key => $collection): ?>

            <div class="controls catalog-collection element-item" data-collection="<?=$collection->collection_id?>">
                <?php echo form_dropdown('collection[' . $collection->collection_id .']', $collections_list, $collection->collection_value); ?>
                <?php if ($key != 0) { ?>
                    <i class="icon-remove remove-exist-collection"></i>
                <?php } ?>
            </div>

            <script id="catalog-collection-template" type="text/x-handlebars-template">
                <div class="controls catalog-collection element-item">
                    <?php echo form_dropdown('new_collection[]', $collections_list, 0); ?>
                    <i class="icon-remove remove-catalog-collection remove-new-item"></i>
                </div>
            </script>

    <?php endforeach; ?>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="button" class="btn add-catalog-collection"><i class="icon-plus"></i> Добавить коллекцию</button>
        </div>
    </div>
<?php endif; ?>



<div class="control-group">
    <label class="control-label" for="meta_title">Meta-Title</label>
    <div class="controls">
        <?php echo form_textarea('meta_title', set_value('meta_title', $item->meta_title)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="meta_keywords">Meta-Keywords</label>
    <div class="controls">
        <?php echo form_textarea('meta_keywords', set_value('meta_keywords', $item->meta_keywords)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="meta_description">Meta-Description</label>
    <div class="controls">
        <?php echo form_textarea('meta_description', set_value('meta_description', $item->meta_description)); ?>
    </div>
</div>


<div class="hidden-block">
    <div class="exist-colors-fields">
        <?php foreach ($colors as $color) {
            echo form_hidden('exist_color[' . $color->id . ']', $color->id_color);
        } ?>
    </div>

    <div class="new-colors-fields">
        <script id="new-color-hidden-field-template" type="text/x-handlebars-template">
            <?php echo form_hidden('new_color[{{new_color_id}}]', '{{color_value}}'); ?>
        </script>
    </div>

<script id="remove-hidden-filed-template" type="text/x-handlebars-template">
    <?php echo form_hidden('remove_exist_{{field_name}}[]', '{{field_value}}'); ?>
</script>

    <div class="remove-exist-colors">

    </div>

    <div class="remove-exist-images">

    </div>

    <div class="remove-exist-groups">

    </div>

    <div class="remove-exist-collections">

    </div>

</div>


<div class="control-group">
    <div class="controls">
        <?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary" id="submit-form"'); ?>
    </div>
</div>

<?php echo form_close();?>

