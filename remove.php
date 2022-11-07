<?php

$this_name = $_GET['this_name'];
$this_path = $_GET['this_path'];
include './configuration/db.php';

if ($connection != null) {
    $sql_img = "DELETE FROM imgs WHERE name = :name";
    $sql_owner = "DELETE FROM owners WHERE img_name = :name";
    $stmt_img = $connection->prepare($sql_img);
    $stmt_owner = $connection->prepare($sql_owner);
    try {
        $stmt_owner->execute(['name' => $this_name]);
        $stmt_img->execute(['name' => $this_name]);
        unlink($this_path);
        header("Location: index.php");
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}