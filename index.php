<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Chavao</title>
</head>
<body>
    <?php require_once 'model.php'; ?>

    <?php
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>

    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'irneh4248';
    $dbname = 'teste';

    $sql = new mysqli($servername, $username, $password, $dbname);

    $result = $sql->query('SELECT * FROM teste');
    ?>
    <table class="table">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Action</th>
        </tr>
        <?php
            for($i=0; $i<$result->num_rows; $i++){
                $row = $result->fetch_assoc();
        ?>
        <tr>
            <td><?php echo $row['firstname'];?></td>
            <td><?php echo $row['lastname'];?></td>
            <td>
                <a href="model.php?delete=<?php echo $row['id'];?>" class="btn">Delete</a>
            </td>
            <td>
                <a href="index.php?update=<?php echo $row['id'];?>" class="btn">Update</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <form action="model.php" method="POST">
        <label>Firstname</label><br>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="text" name="firstname" value="<?php echo $firstname;?>" placeholder="Enter your name">
        <br>
        <br>
        <label>Lastname</label><br>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Enter your lastname">
        <br>
        <br>
        <?php
        if(isset($_GET['update'])){
            echo " <button type='submit' name='update'>Update</button>";
        }
        else{

        ?>
            <button type="submit" name="save">Send</button>
        <?php ;} ?>
    </form>
    </body>
</html>