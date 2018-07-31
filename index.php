<?php

require_once("inc/header.php");


// Get all the messages from my table content

$req = "SELECT u.*, p.* 
FROM posts p, users u
WHERE u.id_user = p.id_user AND status = 1
ORDER BY p.datetime DESC";

$result = $pdo->query($req);

$messages = $result->fetchAll();

?>
<?php if(!userConnect()) : ?>
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Welcome to MyBlog!</h1>
        <h2>Come and share your thoughts with us</h2>
        <p><a class="btn btn-primary btn-lg" href="login.php" role="button">Login &raquo;</a>
        <a class="btn btn-primary btn-lg" href="signup.php" role="button">Signup &raquo;</a></p>
    </div>
</div>

<?php endif; ?>


    <?php foreach($messages as $message) : ?>
        <?php extract($message) ?>

            <div class="blog-post">
                <h2 class="blog-post-title"><?= $title ?></h2>
                <p class="blog-post-meta"><?= $datetime ?> by <?= $nickname ?></p>
                <blockquote>
                <p><?= $content ?></p>
                </blockquote>
            </div>


    <?php endforeach; ?>

<?php
    require_once("inc/footer.php");
?>