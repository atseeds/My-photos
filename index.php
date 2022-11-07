<?php


include './components/header.php'; ?>
<div id="body">
    <div class="container">
        <?php
        include './configuration/db.php';
        if (isset($_SESSION['user'])) {
            if ($connection != null) {
                $sql = "SELECT name ,path FROM owners, imgs WHERE account_email = :email 
            AND owners.img_name = imgs.name";
                $stmt = $connection->prepare($sql);
                $email = $_SESSION['user']['email'];
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute(['email' => $email]);
                while ($row = $stmt->fetch()) {
        ?>

        <div class="container__img">
            <img src="<?php echo $row['path']; ?>" alt="img" width="400" height="300">
            <span style="background-color: black; border-radius: 7px;"><a
                    href="remove.php?this_name=<?php echo $row['name'] . "&this_path=" . $row['path'] ?>">remove</a></span>
        </div> <?php
                        }
                    }
                }
                            ?>

    </div>
    <?php include './components/footer.php'; ?>