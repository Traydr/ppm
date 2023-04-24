<?php
session_start();

$url = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$currentPath = $parsedUrl['path'];
$path_parts =  pathinfo($currentPath);

if (!isLoggedIn()) {
    $allowed_paths = array("index", "login", "register");
    if (!in_array($path_parts['filename'], $allowed_paths)) {
        header("Location: /index.php");
    }
}

function isActive($path): void {
    global $currentPath;
    if ($currentPath === $path) {
        print "active";
    }
}

function isLoggedIn(): bool {
    return isset($_SESSION['uid']);
}

?>

<nav class="navbar sticky-top bg-body-tertiary mb-3">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand <?php isActive('/index.php'); ?>" href="/index.php">
                PHP Password Manager
            </a>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php isActive('/app/home.php'); ?>" aria-current="page"
                   href="/app/home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php isActive('/app/new.php'); ?>" href="/app/new.php">New
                    Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php isActive('/app/generator.php'); ?>"
                   href="/app/generator.php">Generator</a>
            </li>
            <?php if (isLoggedIn()) {
                include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar_change_password.php");
            }?>
        </ul>
        <ul class="nav nav-pills navbar-right">
            <?php if (isLoggedIn()) {
                include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar_logged_in.php");
            } else {
                include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar_logged_out.php");
            } ?>
        </ul>
    </div>
</nav>