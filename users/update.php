<?php
require_once("../inc/header.php");

$page = "Update";


if($_POST) {

    if (empty($msg_error)) {
        $result = $pdo->prepare("SELECT * FROM posts WHERE id_post = :id_post");

        $result->bindValue(':id_post', $_POST['id_post'], PDO::PARAM_STR);

        $result->execute();

        // we register the update
        if (!empty($_GET['id'])){

            $result = $pdo->prepare("UPDATE posts SET content=:content, title=:title WHERE id_post = :id_post");

            //$result->bindValue(':id_user', $_GET['id'], PDO::PARAM_INT);
            
            $result->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
            $result->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
            $result->bindValue(':id_post', $_POST['id_post'], PDO::PARAM_INT);
        }

        if ($result->execute()) {
            if (!empty($_POST['id_post'])) {
                header('location:users_posts.php?m=update');
            }
        }
    }
}

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $req = "SELECT * FROM posts WHERE id_post = :id_post";

    $result = $pdo->prepare($req);
    $result->bindValue(':id_post', $_GET['id'], PDO::PARAM_INT);
    $result->execute();

    if ($result->rowCount() == 1) {
        $update = $result->fetch();
    }
}

// Keep the values entered by the user if problem during the page reloading
// if we receive a POST, the variable will keep the value or if no POST, value = empty
$id_user = (isset($update['id_user'])) ? $update['id_user'] : '';
$content = (isset($update['content'])) ? $update['content'] : '';
$title = (isset($update['title'])) ? $update['title'] : '';
$datetime = (isset($update['datetime'])) ? $update['datetime'] : '';
$id_post = (isset($update['id_post'])) ? $update['id_post'] : ''; 


?>

    <h1><?= $page ?></h1>
    
    <form action="" method="post">
        <input type="hidden" name="id_post" value="<?=$id_post?>"/>
        <div class='form-group'>
            <input type="text" class='form-control' name="title" placeholder="Title" value="<?=$title?>"></input>
        </div>
        <div class='form-group'>
            <textarea class='form-control' name="content" cols="30" rows="10" ><?=$content?></textarea>
        </div>
        <input type="submit" value="Send it" class="btn btn-primary btn-lg btn-block">
    </form>


<?php
require_once("../inc/footer.php");
?>