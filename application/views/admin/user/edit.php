<h3><?php echo empty($user->id) ? 'Создать пользователя' : 'Редактировать пользователя "' . $user->username . '"' ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('', array('class' => 'form-horizontal')); ?>

<div class="control-group">
    <label class="control-label" for="username">Имя пользователя</label>
    <div class="controls">
        <?php echo form_input('username', set_value('username', $user->username)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="password">Пароль</label>
    <div class="controls">
        <?php echo form_password('password', set_value('password', $user->password)); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="password_confirm">Подтверждение</label>
    <div class="controls">
        <?php echo form_password('password_confirm')?>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <?php echo form_submit('submit', 'Сохранить', 'class="btn btn-primary"'); ?>
    </div>
</div>


<?php echo form_close();?>

