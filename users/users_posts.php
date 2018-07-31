<?php

require_once("../inc/header.php");


    // Get all the messages from my table content
    $req = "SELECT u.*, p.* FROM posts p, users u WHERE u.id_user = p.id_user ORDER BY p.datetime DESC";

    $result = $pdo->query($req);

    $messages = $result->fetchAll(); 


    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
            
        $req = "SELECT * FROM posts WHERE id_post = :id_post";

        $result = $pdo->prepare($req);

        $result->bindValue(':id_post', $_GET['id'], PDO::PARAM_INT);

        $result->execute();
        $post = $result->fetch();

        if ($_GET['m'] == "delete"){

            $delete_req = "DELETE FROM posts WHERE id_post = $post[id_post]";

            $delete = $pdo->exec($delete_req);

            if ($delete) {
            header('location: users_posts.php');
            }
        } else if ($_GET['m'] == "publish"){

            //we change the status
            if ($post['status'] == 0){
                $post['status'] = 1;
            }
            elseif ($post['status'] == 1){
                $post['status'] = 0;
            }
            
            $publish_req = "UPDATE posts SET status=$post[status] WHERE id_post = $post[id_post]";
            
            $publish = $pdo->exec($publish_req);
            
            if ($publish) {
            header('location: users_posts.php');
            }
        }

    }

?>

    <h1>My posts</h1>
    <?php foreach($messages as $message) : ?>
        <?php extract($message) ?>
        <?php if($id_user == $_SESSION['user']['id_user']) : ?>

            <div class="blog-post">
                <h2 class="blog-post-title"><?= $title ?></h2>
                <p class="blog-post-meta"><?= $datetime ?> by <?= $nickname ?></p>
                <blockquote>
                <p><?= $content ?></p>
                </blockquote>
                <input type="button" class="btn btn-outline-primary" onclick="window.location.href='<?=URL?>users/update.php?id=<?=$message['id_post']?>'" value="Edit"></input>
                <a type="button" class="btn btn-outline-success" href="?m=publish&id=<?=$message['id_post']?>"><?php if($message['status'] == 0){echo "Publish";}else{echo "Unpublish";} ?></a>
                <a type="button" class="btn btn-outline-danger" href="?m=delete&id=<?=$message['id_post']?>">Delete this post</a>
            </div>

        <?php endif;?>

    <?php endforeach; ?>

<?php
    require_once("../inc/footer.php");
?>
