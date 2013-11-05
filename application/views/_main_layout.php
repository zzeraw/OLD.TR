<?php $this->load->view('components/page_head');?>

<body class="body">
    <?php // var_dump($recent_items) ?>
    <!-- Шапка -->
    <div class="header-background">
        <div class="strip">

        </div>
        <div class="container header">
            <div class="row">
                <div class="span3 header-logo">
                    <a href="<?=site_url()?>">
                        <img src="/assets/img/logo_full.png" class="logo-img" alt="<?=config_item('site_name')?>" title="<?=config_item('site_name')?>" />
                    </a>
                </div>
                <div class="span9 header-content">
                    <div class="breadcrumbs-block">
                    <!-- Хлебные крошки -->
                    <?php if (count($breadcrumbs)) : ?>
                        <ul class="breadcrumb">
                            <?php foreach ($breadcrumbs as $key => $breadcrumb) : ?>
                                <?php if (count($breadcrumbs) != $key+1) { ?>
                                    <li><a href="<?=$breadcrumb[0]?>" title="<?=$breadcrumb[1]?>"><?=$breadcrumb[1]?></a> <span class="divider">/</span></li>
                                <?php } else { ?>
                                    <li class="active"><?=$breadcrumb[1]?></li>
                                <?php } ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    </div>
                    <!-- Верхнее меню -->
                    <div class="user-navigation">
                        <ul>
                        <?php foreach ($horizontal_menu as $section): ?>
                            <?php if ($section->slug == 'homepage') : ?>
                                <?php $section->slug = ''; ?>
                            <?php endif; ?>
                            <li><a href="<?=site_url($section->slug)?>" title="<?=$section->title?>"><?=$section->title?></a></li>
                        <?php endforeach; ?>
                            <li>
                                <a href="http://vk.com/club49366024" title="Ателье Татьяны Разумовой во Вконтакте">
                                    <img width="95" style="border-radius: 5px;" src="/assets/img/vk.png" alt="Группа во Вконтакте" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="clearfix"></div> -->
            </div>
        </div>
    </div>

<div class="backgrounds">
<?php if ((isset($backgrounds)) && (count($backgrounds))) : ?>

    <?php foreach ($backgrounds as $i => $background) : ?>

        <?php $class = ($i > 0) ? 'bgr-active' : ''; ?>

        <div class="background <?=$class?>" style="background-image: url(/uploads/backgrounds/<?=$background->filename?>);"></div>

    <?php endforeach; ?>

<?php endif; ?>
</div>

    <div class="container content">
        <div class="row">
            <div class="span3">
                <!-- Меню слева -->
                <ul class="catalog-menu">
                    <li class="catalog-menu-bold">Коллекции</li>
                        <ul>
                        <?php foreach($vertical_menu['collections'] as $collection): ?>
                            <li class="catalog-menu-regular"><a href="<?=site_url($collection->slug)?>" title="<?=$collection->title?>"><?=$collection->title?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    <?php foreach($vertical_menu['groups'] as $group): ?>
                        <li class="catalog-menu-bold"><a href="<?=site_url($group->slug)?>" title="<?=$group->title?>"><?=$group->title?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="span9 main-content">
                <?php $this->load->view('templates/' . $subview); ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php if (!empty($recent_items)): ?>
            <h4>Вы недавно смотрели:</h4>
            <ul class="thumbnails">
                <?php foreach($recent_items as $item_key => $item): ?>
                <?php if ($item_key > 9): ?>
                    <?php break;?>
                <?php endif; ?>
                <?php if (count($item) == 0)  : ?>
                    <?php continue; ?>
                <?php endif; ?>
                    <?php foreach($recent_images[$item_key] as $image_key => $image): ?>
                        <?php $filename = $image[0]['thumb'];
                        break; ?>
                    <?php endforeach; ?>
                <li class="span2 preview-item">
                    <a href="<?=site_url($this->uri->segment(1) . '/' . $item->id)?>" class="thumbnail" title="<?=$item->title?>">
                        <img class="preview-item-img" src="<?=site_url('uploads/' . $filename)?>" alt="<?=$item->title?>">
                    </a>
                    <div class="preview-item-description">
                        <table>
                            <tr>
                                <td class="cell-name"><?=$item->title?></td>
                                <td rowspan="2" class="cell-price"><?=$item->price?><span class="ruble"> руб.</span></td>
                            </tr>
                            <tr>
                                <td class="cell-more"><a href="<?=site_url($this->uri->segment(1) . '/' . $item->id)?>" title="<?=$item->title?>">Подробнее</a></td>
                            </tr>
                        </table>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

<?php $this->load->view('components/page_tail'); ?>