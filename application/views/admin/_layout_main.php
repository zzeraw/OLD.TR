<?php $this->load->view('admin/components/page_head'); ?>
<body>

<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span11">
                    <div class="btn-toolbar">
                        <?=anchor('', 'Главная', array('class' => 'btn', 'title' => 'Главная страница'))?>
                        <div class="btn-group">
                            <?=anchor('admin/item', 'Товары', array('class' => 'btn', 'title' => 'Список товаров'))?>
                            <?=anchor('admin/item/edit', '+', array('class' => 'btn', 'title' => 'Добавить новый товар'))?>
                        </div>
                        <div class="btn-group">
                            <?=anchor('admin/group', 'Группы', array('class' => 'btn', 'title' => 'Список групп товаров'))?>
                            <?=anchor('admin/group/edit', '+', array('class' => 'btn', 'title' => 'Добавить новую группу'))?>
                        </div>
                        <div class="btn-group">
                            <?=anchor('admin/collection', 'Коллекции', array('class' => 'btn'))?>
                            <?=anchor('admin/collection/edit', '+', array('class' => 'btn'))?>
                        </div>
                        <div class="btn-group">
                            <?=anchor('admin/color', 'Цвета', array('class' => 'btn'))?>
                            <?=anchor('admin/color/edit', '+', array('class' => 'btn'))?>
                        </div>

                        <div class="btn-group">
                            <?=anchor('admin/user', 'Пользователи', array('class' => 'btn'))?>
                            <?=anchor('admin/user/edit', '+', array('class' => 'btn'))?>
                        </div>
                        <div class="btn-group">
                            <?=anchor('admin/section', 'Разделы', array('class' => 'btn'))?>
                        </div>
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Изображения
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><?=anchor('admin/background', 'Фон')?></li>
                                <li><?=anchor('admin/banner', 'Баннеры')?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="span1">
                    <div class="pull-right">
                        <div>
                            <?php echo anchor('admin/user/edit/' . $this->session->userdata('id'), '<i class="icon-user"></i> ' . $this->session->userdata('username')); ?>
                        </div>
                        <div>
                            <?php echo anchor('admin/user/logout', '<i class="icon-off"></i> Выход'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid">
        <?php $this->load->view($subview); ?>
    </div>

<?php $this->load->view('admin/components/page_tail'); ?>



