<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/PrintMessages.php");

session_unset();
session_destroy();

PrintMessages::printInfo("Logging out!");
header("Location: /");
die();