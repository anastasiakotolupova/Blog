<?php
    require_once("inc/header.php");

    $page = "Signup";

if ($_POST) 
{
    // debug($_POST);
    
    // check nickname
    if(!empty($_POST['nickname'])) {

        // function preg_match() allows me to check what info will be be allowed in a result. It takes 2 arguments: REGEX (Regular Expressions) + the result to check. At the end, I will have a TRUE or FALSE condition
        $nickname_verif = preg_match('#^[a-zA-Z0-9-._]{3,20}$#', $_POST['nickname']);
        
        if(!$nickname_verif) {
            $msg_error .= "<div class='alert alert-danger'>Your nickname should countain letters (upper/lower), numbers, between 3 and 20 characters and only '.' and '_' are accepted. Please try again !</div>";
        }
    } else {
        $msg_error .= "<div class='alert alert-danger'>Please enter a valid nickname.</div>";
    }

    // check password
    if(!empty($_POST['password'])) {

        // it means we ask between 6 to 15 characters + 1 UPPER + 1 LOWER + 1 number + 1 symbol
        $pwd_verif = preg_match('#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*\'\?$@%_])([-+!*\?$\'@%_\w]{6,15})$#', $_POST['password']);

        if(!$pwd_verif) {
            $msg_error .= "<div class='alert alert-danger'>Your password should countain between 6 and 15 characters with at least 1 uppercase, 1 lowercase, 1 number and 1 symbol.</div>";
        }
    } else {
        $msg_error .= "<div class='alert alert-danger'>Please enter a valid password.</div>";
    }


    // OTHER CHECKS POSSIBLE HERE

    if(empty($msg_error)) {

        // check if pseudo is free
        $result = $pdo->prepare("SELECT nickname FROM users WHERE nickname = :nickname");

        $result->bindValue(':nickname', $_POST['nickname'], PDO::PARAM_STR);

        $result->execute();

        if($result->rowCount() == 1) {

            $msg_error .= "<div class='alert alert-secondary'>The nickname $_POST[nickname] is already taken, please choose another one.</div>";
        } else {
            $result = $pdo->prepare("INSERT INTO users (nickname, password) VALUES (:nickname, :pwd)");

            // function password_hash() allows us to encrypt the password in a much secure way than md5. It takes 2 arguments: the result to hash, the method
            $hashed_pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $result->bindValue(':nickname', $_POST['nickname'], PDO::PARAM_STR);
            $result->bindValue(':pwd', $hashed_pwd, PDO::PARAM_STR);

            if($result->execute()) {
                header('location:login.php');
            }
        }
    }
}

// Keep the values entered by the user if problem during the page reloading
// if we receive a POST, the variable will keep the value or if no POST, value = empty
$nickname = (isset($_POST['nickname'])) ? $_POST['nickname'] : '';

?>

        <h1><?= $page ?></h1>
        
        <form action="" method="post">
            <small class="form-text text-muted">We will never use your datas for commercial use.</small>
            <?= $msg_error ?>
            <div class="form-group">
                <input type="text" class="form-control" name="nickname" placeholder="Choose a nickname..." value="<?= $nickname ?>" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Choose a password..." required>
            </div>
            <input type="submit" value="Send" class="btn btn-primary btn-lg btn-block">
        </form>
    
<?php
    require_once("inc/footer.php");
?>