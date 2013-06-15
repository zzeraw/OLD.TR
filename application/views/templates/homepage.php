<div class="span4 offset6">
    <?=$section->body?>

    <?php if ( (isset($banners)) && (count($banners)) ) : ?>
        <div class="banners-block">
            <?php foreach ($banners as $banner) : ?>
                <?php if (!empty($banner->link)) : ?>
                    <a href="http://<?=esc($banner->link)?>" title="<?=$banner->title?>">
                <?php endif; ?>
                        <img class="banners" src="<?=site_url('uploads/banners/' . $banner->filename)?>" alt="<?=$banner->title?>">
                <?php if (!empty($banner->link)) : ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>