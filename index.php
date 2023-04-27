<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>
<?php
if (isset($_SESSION['uid'])) {
    echo '<h1 class="text-center">You are logged in! 👍</h1>';
} else {
    echo '<h1 class="text-center">You should log in or register to access the app!</h1>';
}
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php");
