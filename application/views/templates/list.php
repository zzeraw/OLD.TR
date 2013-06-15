<?php if(count($items)): ?>
    <ul class="thumbnails">
    <?php foreach($items as $item): ?>
    <li class="span2 preview-item">
        <a href="<?=site_url($this->uri->segment(1) . '/' . $item->id)?>" class="thumbnail" title="<?=$item->title?>">
            <img class="preview-item-img" src="<?=site_url('uploads/' . $images[$item->id])?>" alt="<?=$item->title?>">
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
<?php else: ?>
    <p>Товары не найдены</p>
<?php endif; ?>

