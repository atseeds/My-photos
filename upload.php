<?php

include './components/header.php';

$upload_dir = 'uploads/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');
$uploadOK = 1;

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["myfile"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOK = 1;
    } else {
        echo "File is not an image.";
        $uploadOK = 0;
    }


    if ($_FILES["myfile"]["size"] > 800000) {
        echo "Sorry, your file is too large.";
        $uploadOK = 0;
    }

    $imgFileType = strtolower(pathinfo($_FILES["myfile"]["name"], PATHINFO_EXTENSION));
    if (!in_array($imgFileType, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOK = 0;
    }

    if ($uploadOK == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        $file_name = $_FILES["myfile"]["name"];
        $rename = time() . '_' . $file_name;
        $des = $upload_dir . $rename;
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $des)) {
            echo "The file " . basename($_FILES["myfile"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        include './configuration/db.php';
        session_start();
        $user = $_SESSION['user'];
        $email = $user['email'];
        $sql_img = "INSERT INTO imgs (name, path) VALUES ('$rename', '$des')";
        $sql_owner = "INSERT INTO owners (account_email, img_name) VALUES ('$email', '$rename');";
        if ($connection != null) {
            try {
                $connection->exec($sql_img);
                $connection->exec($sql_owner);
                header("Location: index.php");
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }
}

?>
<div class="main">
    <form action="upload.php" enctype="multipart/form-data" method="POST">
        <input type="file" name="myfile" />
        <input class="btn-submit" type="submit" value="upload image" name="submit">
    </form>
</div>

<?php

include './components/footer.php';

?>