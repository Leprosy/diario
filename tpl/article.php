<?php $feat = $post->social >= Config::socialFeat ?>
<article class="sub<?php if ($feat) : ?> feat<?php endif; ?>">
    <h1><a href="<?php echo $post->link ?>" target="_blank"><?php echo $post->title ?></a></h1>
    <p class="meta">Publicado <?php echo Html::relativeDate($post->date) ?> vía <?php echo $post->source ?></p>
    <p>
        <?php if ($feat && $post->thumb) : ?>
            <img src="<?php echo $post->thumb ?>" />
        <?php endif; ?>
        <?php echo $feat ? $post->content : Html::words($post->content, 35) ?> ... <a class="more" href="<?php echo $post->link ?>" target="_blank">[Leer más]</a>
    </p>
</article>
