<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>


<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/PrintMessages.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/Database.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/PwdUtils.php");

if (isset($_POST['submit'])) {
    if (empty($_POST['password'])) {
        PrintMessages::printError("Empty Password");
    } elseif (empty($_POST['repeatPassword'])) {
        PrintMessages::printError("Empty Repeated Password");
    } elseif ($_POST['repeatPassword'] !== $_POST['password']) {
        PrintMessages::printError("Passwords do not match");
    } else {
        $password = $_POST['password'];
        changePassword($password);
    }
}

function changePassword($password): void {
    $new_master = PwdUtils::generateMasterKey();
    $passwords = array();

    try {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT pid, password FROM passwords WHERE uid = :uid");
        $stmt->bindParam(":uid", $_SESSION['uid']);

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pid = $row['pid'];
            $old_password = PwdUtils::decryptPassword($row['password']);
            $passwords[$pid] = $old_password;
        }
    } catch (PDOException $e) {
        PrintMessages::printError("Database Error");
    }

    $_SESSION['master_key'] = $new_master;

    foreach ($passwords as $pid => $old_password) {
        updatePassword($pid, $old_password);
    }

    try {
        $new_master_encrypted = PwdUtils::encryptMaster($new_master, $password);
        $new_password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE user SET master_key = :master, pwd = :pwd WHERE uid = :uid");
        $stmt->bindParam(":uid", $_SESSION['uid']);
        $stmt->bindParam(":master", $new_master_encrypted);
        $stmt->bindParam(":pwd", $new_password_hashed);

        $stmt->execute();
    } catch (PDOException $e) {
        PrintMessages::printError("Database Error");
    }
}

/**
 * Updates the password in the database
 * @param string $pid Password ID
 * @param string $password Plain-text Password
 * @return void
 */
function updatePassword(string $pid, string $password): void {
    $current_time = date("Y-m-d H:i:s");
    $encrypted_password = PwdUtils::encryptPassword($password);

    try {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE passwords SET password = :pwd, creation_date = :date WHERE uid = :uid AND pid = :pid");
        $stmt->bindParam(":uid", $_SESSION['uid']);
        $stmt->bindParam(":pid", $pid);
        $stmt->bindParam(":pwd", $encrypted_password);
        $stmt->bindParam(":date", $current_time);

        $stmt->execute();
    } catch (PDOException $e) {
        PrintMessages::printError("Database Error");
    }
}

?>

    <div class="container">
        <form role="form" method="post"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group mb-3">
                <span class="input-group-text">New Password</span>
                <input type="password" class="form-control" placeholder="Password"
                       aria-label="Password"
                       aria-describedby="Password" id="inputPassword" name="password">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Confirm Password</span>
                <input type="password" class="form-control" placeholder="Repeat Password"
                       aria-label="repeatPassword" aria-describedby="repeatPassword"
                       id="inputRepeatPassword" name="repeatPassword">
            </div>
            <div class="input-group justify-content-center mb-3">
                <input type="submit" value="Change Password" name="submit" class="btn btn-primary"/>
            </div>
        </form>
    </div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>