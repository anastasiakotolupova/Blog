<?php require_once("init.php") ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>MyBlog.com | Best blog ever</title>
    
    <link href="https://fonts.googleapis.com/css?family=Forum" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- My CSS -->
    <link href="css/style.css" rel="stylesheet">


  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="<?= URL ?>">MyBlog.com</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= URL ?>">Home <span class="sr-only">(current)</span></a>
          </li>

          <?php if(!userConnect()) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Connect</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="<?= URL ?>login.php">Login</a>
                <a class="dropdown-item" href="<?= URL ?>signup.php">Signup</a>
              </div>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>users/users_posts.php">My posts</a>
            </li>
          <?php endif; ?>

          <?php if(userConnect()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>users/create_post.php">Create new post</a>
            </li>
          <?php endif; ?>

          <?php if(userConnect()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>logout.php">Logout</a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </nav>

    <main role="main" class="container">
        <div class="starter-template">
        