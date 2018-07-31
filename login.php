<?php
    require_once("inc/header.php");

    $page = "Login";

    if($_POST){
        $req = "SELECT * FROM users WHERE nickname = :nickname";

        $result = $pdo->prepare($req);
        $result->bindValue(":nickname", $_POST['nickname'], PDO::PARAM_STR);

        $result->execute();

        // if we select a nickname in the DTB
        if($result->rowCount() > 0){
            $user = $result->fetch();
           
            // function passwor_verify() is link to password_hash(). It allows us to check the correspondance between 2 values: 1rst argument will be the value to check, 2nd argument will be the match value
            if(password_verify($_POST['password'], $user['password'])) {
                foreach ($user as $key => $value) {
                    if($key != 'password'){
                        $_SESSION['user'][$key] = $value;
                    }
                }
                echo '<script>document.location.href="' . URL . 'index.php"</script>';
                exit;
            }
            else {
                $msg_error .= "<div class='alert alert-danger'>Identification error, please try again.</div>";
            }
        } else {
            $msg_error .= "<div class='alert alert-danger'>Identification error, please try again.</div>";
        }  
    }

?>

    <h1><?= $page ?></h1>

    <form action="login.php" method="post">
        <?= $msg_error ?>
        <div class="form-group">
            <input type="text" class="form-control" name="nickname" placeholder="Your nickname..." required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Your password..." required>
        </div>
        <input type="submit" value="Login" class="btn btn-primary btn-lg btn-block">
    </form>

<?php
    require_once("inc/footer.php");
?>