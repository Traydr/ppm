<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>

    <h1 class="text-center">All Your Passwords!</h1>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/print_messages.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/pwd_utils.php");

if (isset($_POST['update'])) {
    $pid = $_POST['pid'];
    $site = $_POST['site'];
    $username = $_POST['username'];
    $password = pwd_utils::encrypt_password($_POST['password']);

    update_password($pid, $site, $username, $password);
} elseif (isset($_POST['delete'])) {
    $pid = $_POST['pid'];
    delete_password($pid);
}

load_passwords();

function load_passwords(): void {
    $uid = $_SESSION['uid'];

    try {
        $db = new db();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM ppm.passwords WHERE uid = :uid");
        $stmt->bindParam(":uid", $uid);

        $stmt->execute();

        if ($stmt->rowCount() <= 0) {
            print("<h2 class='text-center'>You don't have any passwords yet!</h2>");
            return;
        }


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pid = $row['pid'];
            $site = $row['site_name'];
            $username = $row['username'];
            $password = pwd_utils::decrypt_password($row['password']);
            $creation_date = $row['creation_date'];
            create_password_form($pid, $site, $username, $password, $creation_date);
        }
    } catch (PDOException $e) {
        print_messages::printError("Database Error");
    }
}

function create_password_form(int $pid, string $site, string $username, string $password, string $creation_date): void {
    echo '<div class="container mb-5">
    <form role="form" method="post" id="passwordForm" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
        <input type="hidden" id="pid" name="pid" value="' . $pid . '">
        <div class="input-group mb-1">
            <span class="input-group-text">Site</span>
            <input type="text" aria-label="Website" class="form-control" id="site" name="site"
                   value="' . $site . '">
            <span class="input-group-text" id="lastModified">Last Modified: ' . $creation_date . '</span>
            <button class="btn btn-outline-secondary border-warning-subtle" type="submit" name="update">Update</button>
            <button class="btn btn-outline-secondary border-danger-subtle" type="submit" name="delete">Delete</button>
        </div>
        <div class="input-group mb-1">
            <span class="input-group-text">Username</span>
            <input type="text" aria-label="Username" class="form-control" id="username"
                   name="username" value="' . $username . '">
            <span class="input-group-text">Password</span>
            <input type="text" aria-label="password" class="form-control" id="password"
                   name="password" value="' . $password . '">
        </div>
    </form>
</div>';
}

function update_password(int $pid, string $site, string $username, string $password): void {
    $current_time = date("Y-m-d H:i:s");

    try {
        $db = new db();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE passwords SET site_name = :site, username = :user, password = :pwd, creation_date = :date WHERE uid = :uid AND pid = :pid");
        $stmt->bindParam(":uid", $_SESSION['uid']);
        $stmt->bindParam(":pid", $pid);
        $stmt->bindParam(":site", $site);
        $stmt->bindParam(":user", $username);
        $stmt->bindParam(":pwd", $password);
        $stmt->bindParam(":date", $current_time);

        $stmt->execute();
    } catch (PDOException $e) {
        print_messages::printError("Database Error");
    }
}

function delete_password($pid): void {
    try {
        $db = new db();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM passwords WHERE pid = :pid AND uid = :uid");
        $stmt->bindParam(":uid", $_SESSION['uid']);
        $stmt->bindParam(":pid", $pid);

        $stmt->execute();
    } catch (PDOException $e) {
        print_messages::printError("Database Error");
    }
}

?>


<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>