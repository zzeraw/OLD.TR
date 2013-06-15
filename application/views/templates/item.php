<div class="row">
    <div class="span3">
    <?php foreach ($colors as $color_key => $color): ?>
        <?php $hidden_class = 'hidden-block'; ?>
        <?php if (empty($color_key)): ?>
            <?php
                $first_color_id = $color->id;
                $hidden_class = '';
            ?>
        <?php endif; ?>

        <div class="image-block <?=$hidden_class?>" data-image_block_number="<?=$color_key?>">
            <div id="main-image-block" class="big-item-picture zoom">
                <img src="<?=site_url('uploads/' . $images[$color->id][0]['filename'])?>" />
            </div>
            <div id="thumbs-images-block">
                <?php foreach ($images[$color->id] as $image): ?>
                <div class="pull-left">
                    <img width=55 class="thumb-item-picture" src="<?=site_url('uploads/' . $image['thumb'])?>" data-full_image="<?=site_url('uploads/' . $image['filename'])?>" />
                </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="span6">

    <div class="item-info">
        <div class="item-more"><a href="<?=site_url($this->uri->segment(1))?>" class="pull-right">Вернуться к списку товаров</a></div>
        <dl class="dl-horizontal">
            <dt></dt>
            <dd class="item-name"><?=$item->title?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt></dt>
            <dd class="item-price"><?=$item->price?> руб.</dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Артикул</dt>
            <dd><?=$item->article?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Состав</dt>
            <dd><?=$item->composition?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Описание</dt>
            <dd><?=$item->body?></dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Цвета</dt>
            <dd id="colors-list">
            <?php foreach ($colors as $color_key => $color): ?>
                <?php foreach ($colors_list as $color_item): ?>
                    <?php if ($color->id_color == $color_item->id): ?>
                    <?php
                    if ($first_color_id == $color->id) {
                        $selected = 'color-selected';
                        $color_title = $color_item->title;
                    } else {
                        $selected = '';
                    }
                    ?>
                       <img class="color <?=$selected?>" width=30 src="<?=site_url('uploads/colors/' . $color_item->filename)?>" alt="<?=$color_item->title?>" title="<?=$color_item->title?>" data-color_number="<?=$color_key?>" data-color_value="<?=$color->id?>" />
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Размеры</dt>
            <?php foreach ($colors as $color_key => $color): ?>
                <?php $hidden_class = 'hidden-block'; ?>
                <?php if (empty($color_key)): ?>
                    <?php
                        $hidden_class = '';
                    ?>
                 <?php endif; ?>
                <dd class="sizes-block <?=$hidden_class?>" data-sizes_block_number="<?=$color_key?>">
                    <?php if (isset($sizes[$color->id])): ?>
                        <?php foreach ($sizes[$color->id] as $key_size => $size):  ?>
                        <?php
                            if (empty($key_size)) {
                                $selected = 'size-selected';
                            } else {
                                $selected = '';
                            }
                            ?>
                            <span class="size <?=$selected?>" data-size_value="<?=$size['size']?>"><?=$size['size'] . ' '?></span>
                        <?php endforeach; ?>
                        <span id="launch-size-table" class="launch-size-table" ><a href="#size-table" data-toggle="modal">Определите свой размер</a></span>
                        <!-- Modal -->
                        <div id="size-table" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Таблица размеров</h3>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped table-bordered">
                                    <caption>Таблица российских размеров женской одежды. Для роста 160-168 см.</caption>
                                    <thead>
                                        <tr>
                                            <th>Российский размер</th>
                                            <th>Обхват груди, см.</th>
                                            <th>Обхват талии, см.</th>
                                            <th>Обхват бедер, см.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>40</td>
                                            <td>80</td>
                                            <td>60</td>
                                            <td>88</td>
                                        </tr>
                                        <tr>
                                            <td>42</td>
                                            <td>84</td>
                                            <td>64</td>
                                            <td>92</td>
                                        </tr>
                                        <tr>
                                            <td>44</td>
                                            <td>88</td>
                                            <td>68</td>
                                            <td>96</td>
                                        </tr>
                                        <tr>
                                            <td>46</td>
                                            <td>92</td>
                                            <td>72</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td>48</td>
                                            <td>96</td>
                                            <td>76</td>
                                            <td>104</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
                            </div>
                        </div>
                    <?php endif; ?>
                </dd>
            <?php endforeach; ?>
        </dl>
    </div>

    <div class="order-form">

        <?php echo form_open('', array('class' => 'form-horizontal')); ?>

            <div class="order-title">Заказать</div>

            <?php
            $error = validation_errors();
            if ((!empty($error))) : ?>
                <div class="alert alert-error">
                    <?=$error?>
                </div>
            <?php endif; ?>

            <?php $error = $this->session->flashdata('error'); ?>
            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <?=$error?>
                </div>
            <?php ?>
            <?php endif; ?>

            <?php $success = $this->session->flashdata('success'); ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <?=$success?>
                </div>
            <?php ?>
            <?php endif; ?>

            <dl class="dl-horizontal order-fields">
                <dt>Цвет</dt>
                <dd class="color-span"><?=$color_title?></dd>
            </dl>
            <dl class="dl-horizontal order-fields">
                <dt>Размер</dt>
                <dd class="size-span"><?=$sizes[$first_color_id][0]['size']?></dd>
            </dl>

            <div class="order-fields">
                <div>
                    <input type="text" name="fio" placeholder="Ф.И.О." />
                </div>

                <div>
                    <input type="text" name="phone" placeholder="Телефон" />
                </div>

                <div>
                    <input type="text" name="email" placeholder="Email" />
                </div>

                <div>
                    <textarea name="comment" id="" cols="10" rows="5" placeholder="Комментарий"></textarea>
                </div>

                <div>
                    <button id="submit" class="btn btn-primary btn-small order-button pull-right" type="submit">Заказать</button>
                </div>

                <div class="hidden-fields">
                    <input type="hidden" name="color" value="<?=$first_color_id?>" />
                    <input type="hidden" name="size" value="<?=$sizes[$first_color_id][0]['size']?>" />
                </div>
            </div>

        <?php echo form_close();?>
    </div>
</div>

</div>