<?php if ($feat) : ?>
<div class="pure-u-1" id="main-header">
<?php else: ?>
<div class="pure-u-1 pure-u-md-1-3" id="secondary-headers">
<?php endif; ?>

    <div class="post">

        <?php if ($feat) : ?>
        <h1><a href="<?php echo $post["url"] ?>"><?php echo $post["title"] ?></a></h1>
        <?php else: ?>
        <h2><a href="<?php echo $post["url"] ?>"><?php echo $post["title"] ?></a></h2>
        <?php endif; ?>

        <?php include("meta.php"); ?>

        <img src="<?php echo $post["image"] ?>" class="pure-img" />
        <p><?php echo $post["text"]?></p>

        <?php include("social.php"); ?>
    </div>
</div>