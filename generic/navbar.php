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

function isActive(string $path): void {
    global $currentPath;
    if ($currentPath === $path) {
        print "active";
    }
}

function isActiveReturn(string $path): string {
    global $currentPath;
    if ($currentPath === $path) {
        return "active";
    }
    return "";
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
                $isActiveChange = isActiveReturn('/app/change_password.php');
                echo '
                    <li class="nav-item">
                        <a class="nav-link ' . $isActiveChange . '" href="/app/change_password.php">Change Password</a>
                    </li>';
            }?>
        </ul>
        <ul class="nav nav-pills navbar-right">
            <?php if (isLoggedIn()) {
                $navbarUsername = $_SESSION['username'];
                echo '
                    <li class="nav-item">
                        <a class="nav-link text-bg-secondary">Welcome ' . $navbarUsername . ' </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/app/logout.php">Logout</a>
                    </li>';
            } else {
                $isActiveRegister = isActiveReturn('/app/register.php');
                $isActiveLogin = isActiveReturn('/app/login.php');
                echo '
                    <li class="nav-item">
                        <a class="nav-link ' . $isActiveRegister . ' " href="/app/register.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ' . $isActiveRegister . ' " href="/app/login.php">Login</a>
                    </li>';
            } ?>
        </ul>
    </div>
</nav>