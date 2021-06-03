<?php

session_start();

$firstname='';
$lastname='';
$id=0;

$servername = 'localhost';
$username = 'root';
$password = 'irneh4248';
$dbname = 'teste';

$sql = new mysqli($servername, $username, $password, $dbname);

function create($sql, $dbname){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sql->query("INSERT INTO $dbname (firstname, lastname) VALUES ('$firstname', '$lastname')");

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

function update($sql, $dbname){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $id = $_POST['id'];
    $sql->query("UPDATE $dbname SET firstname='$firstname', lastname='$lastname' WHERE id=$id");

    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

function delete($sql, $dbname){
    $id = $_GET['delete'];
    $sql->query("DELETE FROM $dbname WHERE id=$id") or die($sql->error());

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}


if(isset($_POST['save'])){
    create($sql, $dbname);
}

if(isset($_GET['delete'])){
    delete($sql,$dbname);
}


if(isset($_GET['update'])){

    $id = $_GET['update'];
    $result = $sql->query("SELECT * FROM $dbname WHERE id=$id") or die ($sql->error());

    if($result->num_rows==1){
        $row = $result->fetch_array();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }
}

if(isset($_POST['update'])){
    update($sql, $dbname);
}
$sql->close();