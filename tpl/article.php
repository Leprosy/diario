<?php $feat = $post->social >= Config::socialFeat ?>
<article class="sub<?php if ($feat) : ?> feat<?php endif; ?>" onclick="window.open('<?php echo $post->link ?>')">
    <h1><?php echo $post->title ?></h1>
    <p class="meta">Publicado <?php echo Html::relativeDate($post->date) ?> vía <b><?php echo $post->source ?></b></p>
    <p>
        <?php if ($feat && $post->thumb) : ?>
            <img src="<?php echo $post->thumb ?>" />
        <?php endif; ?>
        <?php echo $feat ? $post->content : Html::words($post->content, 35) ?> ...
    </p>
</article>
