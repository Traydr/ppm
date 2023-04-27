<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/print_messages.php");

session_unset();
session_destroy();

print_messages::printInfo("Logging out!");
header("Location: /");
die();