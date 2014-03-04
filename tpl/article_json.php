<?php $post->feat = $post->social >= Config::socialFeat ?>
<?php $post->reldate = Html::relativeDate($post->date) ?>
<?php echo json_encode($post, JSON_HEX_QUOT) ?>