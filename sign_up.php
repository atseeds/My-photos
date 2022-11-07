<?php
include './components/header.php';
include './configuration/db.php';


$email = $password = "";
$emailErr = $passwordErr = "";
$rPassword = $rPasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $passwordErr = "Password must include at least one number";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $passwordErr = "Password must include at least one capital letter";
        }
    }
    if (empty($_POST["rPassword"])) {
        $rPasswordErr = "Re-enter Password";
    } else {
        $rPassword = test_input($_POST["rPassword"]);
        if ($rPassword != $password) {
            $rPasswordErr = "Passwords do not match";
        }
    }
    if (empty($rPasswordErr) and empty($passwordErr) and empty($emailErr)) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO accounts (email, PASSWORD ) VALUES ('$email', '$pass')";
        $sql_check = "SELECT * FROM accounts WHERE email = '$email'";
        if ($connection != null) {
            try {
                $result = $connection->query($sql_check);
                $data = $result->fetch();
                if ($data) {
                    $emailErr = "Email already exists";
                } else {
                    $connection->query($sql);
                    header("Location: sign_in.php");
                }
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
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
                <h1>Sign Up</h1>
                <div>Please sign up</div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-card-form">
                <div class="form-item">
                    <span class="form-item-icon material-symbols-outlined">mail</span>
                    <input type="text" placeholder="Enter email" name="email" value="<?php echo $email; ?>" autofocus
                        required>
                    <span class="error">*<?php echo $emailErr; ?></span>
                </div>
                <div class="form-item">
                    <span class="form-item-icon material-symbols-outlined">lock</span>
                    <input type="password" placeholder="Enter password" name="password" value="<?php echo $password; ?>"
                        required>
                    <span class="error">*<?php echo $passwordErr; ?></span>
                </div>
                <div class="form-item">
                    <span class="form-item-icon material-symbols-outlined">lock</span>
                    <input type="password" placeholder="Enter password again" name="rPassword"
                        value="<?php echo $rPassword; ?>" required>
                    <span class="error">*<?php echo $rPasswordErr; ?></span>
                </div>
                <div class="form-item-other">
                    <div class="checkbox">
                        <input type="checkbox" id="rememberMeCheckbox" <?php echo "checked"; ?>>
                        <label for="rememberMeCheckbox">Remember me</label>
                    </div>
                    <a href="#">I forgot my password</a>
                </div>
                <button type="submit">Sign up</button>
            </form>
            <div class="login-card-footer">Don't have an account? <a href="sign_up.php">Create an account</a></div>
        </div>

        <?php
        echo $email . " " . $password;
        ?>
    </div>
</div>