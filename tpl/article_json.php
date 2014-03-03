<?php $feat = $post->social >= Config::socialFeat ?>
{
    "url": "<?php echo $post->link ?>",
    "title": "<?php echo $post->title ?>",
    "reldate": "<?php echo Html::relativeDate($post->date) ?>",
    "date": "<?php echo $post->date ?>",
    "source": "<?php echo $post->source ?>",
    "thumb": "<?php if ($post->thumb) : ?><?php echo $post->thumb ?><?php endif; ?>",
    "content": "<?php echo $post->content ?>",
    "feat": <?php echo $feat ? "true" : "false" ?>
}