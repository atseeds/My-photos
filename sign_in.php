<?php
include './components/header.php';
include './configuration/db.php';

$email = $password = "";
$inforErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($connection != null) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM accounts WHERE email = '$email'";
        $result = $connection->query($sql);
        $data = $result->fetch();
        // var_dump($data['date']);
        if ($data) {
            if (password_verify($password, $data["PASSWORD"])) {

                $_SESSION['user'] = $data;

                // var_dump($_SESSION['user']);
                header("Location: index.php");
            } else {
                $inforErr = "Email or Password is incorrect";
            }
        } else {
            $inforErr = "Email or Password is incorrect";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<div id="main">
    <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="img/logo.svg" alt="logo">
            </div>
            <div class="login-card-header">
                <h1>Sign In</h1>
                <div>Please sign in</div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-card-form">
                <div class="form-item">
                    <span class="form-item-icon material-symbols-outlined">mail</span>
                    <input type="text" placeholder="Enter email" name="email" value="<?php echo $email; ?>" autofocus
                        required>
                    <span class="error">*<?php echo $inforErr; ?></span>
                </div>
                <div class="form-item">
                    <span class="form-item-icon material-symbols-outlined">lock</span>
                    <input type="password" placeholder="Enter password" name="password" value="<?php echo $password; ?>"
                        required>
                    <span class="error">*<?php echo $inforErr; ?></span>
                </div>
                <div class="form-item-other">
                    <div class="checkbox">
                        <input type="checkbox" id="rememberMeCheckbox" <?php echo "checked"; ?>>
                        <label for="rememberMeCheckbox">Remember me</label>
                    </div>
                    <a href="#">I forgot my password</a>
                </div>
                <button type="submit">Sign in</button>
            </form>
            <div class="login-card-footer">Don't have an account? <a href="sign_up.php">Create an account</a></div>
        </div>

    </div>