<?php

require_once('inc/init.php');

// we delete the datas linked to the user session
unset($_SESSION['user']);

header('location:index.php');