<h3><?php echo empty($section->id) ? 'Добавление нового раздела' : 'Редактировать раздел "' . $section->title . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('', array('class' => 'form-horizontal')); ?>

<div class="control-group">
    <label class="control-label" for="title">Название</label>
    <div class="controls">
        <?=form_input('title', set_value('title', $section->title));?>
    </div>
</div>

<!--  <div class="control-group">
    <label class="control-label" for="slug">Латинское название</label>
    <div class="controls">
        <?=form_input('slug', set_value('slug', $section->slug));?>
    </div>
</div> -->

<div class="control-group">
    <label class="control-label" for="body">Содержимое</label>
    <div class="controls">
        <?php echo form_textarea('body', set_value('body', $section->body), 'class="tinymce"'); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="meta_title">Meta-Title</label>
    <div class="controls">
        <?php echo form_textarea('meta_title', set_value('meta_title', $section->meta_title)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="meta_keywords">Meta-Keywords</label>
    <div class="controls">
        <?php echo form_textarea('meta_keywords', set_value('meta_keywords', $section->meta_keywords)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="meta_description">Meta-Description</label>
    <div class="controls">
        <?php echo form_textarea('meta_description', set_value('meta_description', $section->meta_description)); ?>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
    </div>
</div>

<?php echo form_close();?>



