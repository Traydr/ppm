<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/PrintMessages.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/Database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/PwdUtils.php");

if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
        PrintMessages::printError("Empty Username");
    } elseif (empty($_POST['password'])) {
        PrintMessages::printError("Empty Password");
    } else {
        $name = $_POST['username'];
        $password = $_POST['password'];
        loginUser($name, $password);
    }
}

/**
 * Logs the user in, and sets the session variables
 * @param string $username The username of the user
 * @param string $password Plain text password of the user
 * @return void
 */
function loginUser(string $username, string $password): void {
    try {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? LIMIT 1;");
        $stmt->bindParam(1, $username);

        $stmt->execute();
        if ($stmt->rowCount() != 1) {
            PrintMessages::printError("Invalid Username Or Password");
            return;
        }

        $result = $stmt->fetch();

        $uid = $result['uid'];
        $master_key_result = $result['master_key'];
        $pwd = $result['pwd'];
        $username = $result['username'];

        if (!password_verify($password, $pwd)) {
            PrintMessages::printError("Invalid Username Or Password");
            return;
        }

        // Apparently sessions are actually pretty secure already, though
        // session_regenerate_id() should be called after each login attempt
        session_regenerate_id();
        $master_key_decrypted = PwdUtils::decryptMaster($master_key_result, $password);

        $_SESSION['uid'] = $uid;
        $_SESSION['master_key'] = $master_key_decrypted;
        $_SESSION['username'] = $username;

        PrintMessages::printInfo("Login Successful");
    } catch (PDOException $e) {
        // Silently fail
        PrintMessages::printError("Database Error");
        die();
    }

    unset($stmt);
    unset($db);
    header("Location: /app/home.php");
}

?>

<div class="container">
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputUsernamePrefix">@</span>
            <input type="text" class="form-control" placeholder="Username"
                   aria-label="inputUsernamePrefix" aria-describedby="inputUsernamePrefix"
                   id="inputUsername" name="username">
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                   aria-describedby="Password" id="inputPassword" name="password">
        </div>
        <div class="input-group justify-content-center mb-3">
            <input type="submit" value="Sign in" name="submit" class="btn btn-primary"/>
        </div>
    </form>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>
