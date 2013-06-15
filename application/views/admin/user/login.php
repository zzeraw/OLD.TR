<div class="modal-header">
	<h3>Авторизация</h3>
</div>
<div class="modal-body">
<?php echo validation_errors(); ?>
<?php echo form_open('', array('class' => 'form-horizontal')); ?>

<div class="control-group">
    <label class="control-label" for="username">Имя пользователя</label>
    <div class="controls">
        <?php echo form_input('username')?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="password">Пароль</label>
    <div class="controls">
        <?php echo form_password('password')?>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <?php echo form_submit('submit', 'Вход', 'class="btn btn-primary"'); ?>
    </div>
</div>

<?php echo form_close();?>
</div>