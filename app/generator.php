<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/header.php") ?>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/navbar.php") ?>
    <h1 class="text-center">Password Generator</h1>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/print_messages.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/generator/password_generator.php");

$chars = 20;
if (isset($_POST['chars'])) {
    $chars = $_POST['chars'];
}

$specialChars = true;
if (!isset($_POST['specialChars'])) {
    $specialChars = false;
}

$numbers = true;
if (!isset($_POST['numbers'])) {
    $numbers = false;
}

$uppercase = true;
if (!isset($_POST['uppercase'])) {
    $uppercase = false;
}

$lowercase = true;
if (!isset($_POST['lowercase'])) {
    $lowercase = false;
}

if (isset($_POST['submit'])) {
    print ("<h2 class='text-center'>" . generatePassword($chars, $specialChars, $numbers, $uppercase, $lowercase) . "</h2>");
}

/**
 * Generates a password according to the given parameters. Returns an error message if the parameters are invalid.
 * @param int $chars A number between 1 and 128
 * @param bool $specialChars True if special characters should be included
 * @param bool $numbers True if numbers should be included
 * @param bool $uppercase True if uppercase letters should be included
 * @param bool $lowercase True if lowercase letters should be included
 * @return string The generated password
 */
function generatePassword(int $chars, bool $specialChars, bool $numbers, bool $uppercase, bool $lowercase): string {
    $gen = new password_generator($chars, $numbers, $specialChars, $uppercase, $lowercase);
    try {
        return $gen->generate();
    } catch (Exception $e) {
        return "<div class='text-danger'><p>" . $e->getMessage() . "</p></div>";
    }
}

?>
    <div class="container">
        <form role="form" method="post"
              action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group mb-3">
                <span class="input-group-text">Number of characters</span>
                <input type="number" class="form-control" placeholder="Number of characters"
                       aria-label="numChars" aria-describedby="numChars"
                       id="numChars" name="chars" min="1" max="128" value="<?php echo $chars ?>">
            </div>
            <div class="input-group mb-3">
                <span class="form-control">Include special characters</span>
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox"
                           aria-label="Checkbox" name="specialChars"
                           id="specialChars" <?php echo($specialChars ? "checked" : null) ?>>
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="form-control">Include numbers</span>
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox"
                           aria-label="Checkbox" name="numbers"
                           id="numbers" <?php echo($numbers ? "checked" : null) ?> >
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="form-control">Include Upper-case letters</span>
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox"
                           aria-label="Checkbox" name="uppercase"
                           id="uppercase" <?php echo($uppercase ? "checked" : null) ?> >
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="form-control">Include Lower-case letters</span>
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox"
                           aria-label="Checkbox" name="lowercase"
                           id="lowercase" <?php echo($lowercase ? "checked" : null) ?>
                </div>
            </div>

            <div class="input-group justify-content-center mb-3">
                <input type="submit" value="Generate" name="submit" class="btn btn-primary"/>
            </div>
        </form>
    </div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/generic/footer.php") ?>