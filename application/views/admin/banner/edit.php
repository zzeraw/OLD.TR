<h3><?php echo empty($banner->id) ? 'Добавление баннера' : 'Редактировать баннер "' . $banner->title . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php foreach ($errors as $error): ?>
    <div><?=$error?></div>
<?php endforeach; ?>
<?php echo form_open_multipart('', array('class' => 'form-horizontal')); ?>

<div class="control-group">
    <label class="control-label" for="title">Название</label>
    <div class="controls">
        <?=form_input('title', set_value('title', $banner->title));?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="link">Ссылка</label>
    <div class="controls">
        <?=form_input('link', set_value('link', $banner->link));?>
    </div>
</div>

 <div class="control-group">
    <label class="control-label" for="filename">Картинка баннера</label>
    <?php if (isset($banner->filename)): ?>
    <div class="controls">
        <img width=200 src="<?=site_url('uploads/banners/' . $banner->filename)?>" alt="">
    </div>
    <?php endif; ?>
    <div class="controls">
        <?=form_upload('filename');?>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
    </div>
</div>

<?php echo form_close();?>



