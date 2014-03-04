{
    "feat": [
    <?php if (count($feat)) : ?>
    <?php foreach ($feat as $i => $post) : ?>
    <?php include('tpl/article_json.php') ?><?php if ($i < 3) : ?>,<?php endif; ?>
    <?php endforeach; ?>
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