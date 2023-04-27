<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>

    <h1 class="text-center">Add a new password!</h1>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/PrintMessages.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/Database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/PwdUtils.php");

if (isset($_POST["submit"])) {
    if (empty($_POST["site"])) {
        PrintMessages::printError("Missing site name");
    } elseif (empty($_POST["username"])) {
        PrintMessages::printError("Missing username");
    } elseif (empty($_POST["password"])) {
        PrintMessages::printError("Missing password");
    } else {
        createNewPassword($_POST["site"], $_POST["username"], $_POST["password"]);
        unset($_POST["site"]);
        unset($_POST["username"]);
        unset($_POST["password"]);
    }
}

function createNewPassword(string $site, string $username, string $password): void {
    $current_time = date("Y-m-d H:i:s");
    $encrypted_password = PwdUtils::encryptPassword($password);
    try {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO passwords (uid, password, username, site_name, creation_date) VALUES (:uid, :pwd, :user, :site, :date)");
        $stmt->bindParam(':uid', $_SESSION['uid']);
        $stmt->bindParam(':pwd', $encrypted_password);
        $stmt->bindParam(':user', $username);
        $stmt->bindParam(':site', $site);
        $stmt->bindParam(':date', $current_time);

        $stmt->execute();

        PrintMessages::printInfo("Password created!");
        unset($stmt);
        unset($db);
    } catch (PDOException $e) {
        PrintMessages::printError("Database Error");
    }
}

?>

    <div class="container">
        <form role="form" method="post"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputSitePrefix">Site name</span>
                <input type="text" class="form-control" placeholder="Website Name"
                       aria-label="inputSitePrefix" aria-describedby="inputSitePrefix"
                       id="inputSite" name="site" value="<?php echo $_POST['site']; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputUsernamePrefix">Username</span>
                <input type="text" class="form-control" placeholder="Username"
                       aria-label="inputUsernamePrefix" aria-describedby="inputUsernamePrefix"
                       id="inputUsername" name="username" value="<?php echo $_POST['username']; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputPasswordPrefix">Password</span>
                <input type="password" class="form-control" placeholder="Password"
                       aria-label="Password" aria-describedby="Password" id="inputPassword"
                       name="password" value="">
            </div>
            <div class="input-group justify-content-center mb-3">
                <input type="submit" value="Create Password" name="submit" class="btn btn-primary"/>
            </div>
        </form>
    </div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>