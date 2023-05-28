<?php
session_start();
session_destroy();
header("location:index.php?al=".sha1('signout'));
?>