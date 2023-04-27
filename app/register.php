<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/print_messages.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/db_utils.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/pwd_utils.php");


$db_utils = new db_utils();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeatPassword'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
}


if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
        print_messages::printError("Empty Username");
    } elseif (empty($_POST['password'])) {
        print_messages::printError("Empty Password");
    } elseif (empty($_POST['repeatPassword'])) {
        print_messages::printError("Empty Repeated Password");
    } elseif ($repeatPassword !== $password) {
        print_messages::printError("Passwords do not match");
    } elseif (strlen($name) > 30) {
        print_messages::printError("Username too long");
    } elseif ($db_utils->usernamesExists($name)) {
        print_messages::printError("Username already exists");
    } else {
        register_user($password, $name);
    }
}

/**
 * Registers a new user in the database
 * @param string $password Their plain-text password
 * @param string $name Username
 * @return void
 */
function register_user(string $password, string $name): void {
    // DB vars
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $master_key_encode = pwd_utils::generate_master_key();
    $master_key = pwd_utils::encrypt_master($master_key_encode, $password);

    // Database stuff
    try {
        $db = new db();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO user (username, pwd, master_key) VALUES (:name, :pwd, :master)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":pwd", $password_hash);
        $stmt->bindParam(":master", $master_key);

        // execute
        $stmt->execute();
        unset($stmt);
        unset($db);
    } catch (PDOException $e) {
        // Silently fail
        print_messages::printError("Database Error");
        die();
    }
    print_messages::printInfo("Registration Complete");
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
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Repeat Password"
                   aria-label="repeatPassword"
                   aria-describedby="repeatPassword" id="inputRepeatPassword" name="repeatPassword">
        </div>
        <div class="input-group justify-content-center mb-3">
            <input type="submit" value="Create Account" name="submit" class="btn btn-primary"/>
        </div>
    </form>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>
