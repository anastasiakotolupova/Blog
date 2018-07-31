<?php

require_once("../inc/header.php");

//debug($_SESSION['user']['id_user']);
if($_POST)
    {
        foreach($_POST as $key => $value) {
            $_POST[$key] = addslashes($value);
        }

        if(empty($msg_error)) {

            // we register the insert
            $result = $pdo->prepare("INSERT INTO posts (id_user, content, title, status, picture, datetime) VALUES (:id_user, :content, :title, 0, '',NOW())");
            
            $result->bindValue(':id_user', $_SESSION['user']['id_user'], PDO::PARAM_INT);
            $result->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
            $result->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
            //debug($result->errorInfo());
            // if the request was inserted in the DTB
            $test = $result->execute();
            debug($test->errorInfo());
            if($test){

                echo '<script>document.location.href="' . URL . 'users/users_posts.php"</script>';
            
            } else {  
                echo "error";
            }
        }
    }

?>


<h4>New post:</h4>
<form action="" method="post">
    <div class='form-group'>
        <textarea class='form-control' name="title" cols="10" rows="1" placeholder="Title"></textarea>
    </div>
    <div class='form-group'>
        <textarea class='form-control' name="content" cols="30" rows="10"></textarea>
    </div>
    <input type="submit" value="Send it" class="btn btn-primary btn-lg btn-block">
</form>


<?php
require_once("../inc/footer.php");
?>