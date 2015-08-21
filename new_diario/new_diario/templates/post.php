<?php $featured = ($post["fb"] + $post["tw"] > 50); ?>

<div class="pure-u-1 pure-u-md-1-2 pure-u-lg-1-3 pure-u-xl-1-4">
    <?php if ($featured) : ?>
    <div class="post featured">
    <?php else: ?>
    <div class="post">
    <?php endif; ?>

        <h3><a href="<?php echo $post["url"] ?>"><?php echo $post["title"] ?></a></h3>

        <?php include("meta.php")?>

        <?php if ($featured) : ?><img src="<?php echo $post["image"] ?>" class="pure-img" /><?php endif; ?>
        <p><?php echo $post["text"] ?></p>

        <?php include("social.php") ?>
    </div>
</div>