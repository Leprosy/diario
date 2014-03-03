{
    "feat": [
    <?php if (count($feat)) : ?>
    {
        "url": "<?php echo $feat[0]->link ?>",
        "title": "<?php echo $feat[0]->title ?>",
        "reldate": "<?php echo Html::relativeDate($feat[0]->date) ?>",
        "date": "<?php echo $feat[0]->date ?>",
        "source": "<?php echo $feat[0]->source ?>",
        "thumb": "<?php if ($feat[0]->thumb) : ?><?php echo $feat[0]->thumb ?><?php endif; ?>",
        "content": "<?php echo $feat[0]->content ?>"
    }
    <?php for ($i = 1; $i < count($feat); ++$i) : ?>
    ,{
        "url": "<?php echo $feat[$i]->link ?>",
        "title": "<?php echo $feat[$i]->title ?>",
        "reldate": "<?php echo Html::relativeDate($feat[$i]->date) ?>",
        "date": "<?php echo $feat[$i]->date ?>",
        "source": "<?php echo $feat[$i]->source ?>",
        "thumb": "<?php if ($feat[$i]->thumb) : ?><?php echo $feat[$i]->thumb ?><?php endif; ?>",
        "content": "<?php echo $feat[$i]->content ?>"
    }
    <?php endfor; ?>
    <?php endif; ?>
    ],

    "stream": [
    <?php if (count($stream)) : ?>
        <?php foreach($stream as $i => $post) : ?>
        <?php include('tpl/article_json.php') ?><?php if ($i + 1 < Config::pageSize) : ?>,<?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    ]
}