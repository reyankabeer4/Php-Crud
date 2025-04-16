<?php

include "config.php";


if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM STUDENTS WHERE ID = $id";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_num_rows($result);
    $output = "";

    if ($rows > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            $name = $data["name"];
            $email = $data["email"];
            $batch = $data["batch"];
            $contact = $data["contact"];
            $image = $data["image"];
            $gender = $data["gender"];

            $subject = $data["subject"];
            $subjectArray = explode(",", $subject);

            $enrollment_date = $data["enrollment_date"];
        }
    }

}


if (isset($_POST["update"])) {

    $id = $_GET["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $batch = $_POST["batch"];


    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]['tmp_name'];
        $imageName = $_FILES["image"]['name'];
        move_uploaded_file($image, "./stdImages/" . $imageName);
    } else {
        $imageName = $image; // retain old image name from DB
    }

    $contact = $_POST["contact"];

    $subject = isset($_POST['subject']) ? implode(",", $_POST['subject']) : '';
    $gender = $_POST["gender"];
    $enrollment_date = $_POST["enrollment_date"];

    $update_query = "UPDATE STUDENTS SET name = '$name' , email = '$email' , batch = '$batch' , image = '$imageName' , contact = '$contact' , subject = '$subject' , gender = '$gender' , enrollment_date = '$enrollment_date' where id = $id";

    $result = mysqli_query($conn, $update_query);

    if ($result == true) {
        echo "<script>window.location.href='read.php';</script>";

    } else {
        echo "Something went wrong";
    }


}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Edit Form</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Name</label>
        <input type="text" name="name" value="<?php echo $name ?>" placeholder="Enter Name">
        <label for="">Email</label>
        <input type="text" name="email" value="<?php echo $email ?>" placeholder="Enter Email">
        <label for="">Batch</label>
        <input type="text" name="batch" value="<?= $batch ?>" placeholder="Enter Batch">
        <label for="">Image</label>
        <img src="./stdImages/<?php echo $image ?>" alt="<?= $name ?>">
        <input type="file" name="image">
        <label for="">Contact</label>
        <input type="text" name="contact" value="<?= $contact ?>" placeholder="Enter Contact">
        <label for="">Subjects</label>
        <hr>
        <div class="div-center">
            <label for="chemistry">Chemistry</label>
            <input type="checkbox" id="chemistry" name="subject[]" value="chemistry" <?= in_array("chemistry", $subjectArray) ? "checked" : "" ?>>

            <label for="maths">Maths</label>
            <input type="checkbox" id="maths" name="subject[]" value="maths" <?= in_array("maths", $subjectArray) ? "checked" : "" ?>>

            <label for="physics">Physics</label>
            <input type="checkbox" id="physics" name="subject[]" value="physics" <?= in_array("physics", $subjectArray) ? "checked" : "" ?>>

            <label for="computer">Computer</label>
            <input type="checkbox" id="computer" name="subject[]" value="computer" <?= in_array("computer", $subjectArray) ? "checked" : "" ?>>
        </div>

        <hr>
        <label for="">Select Gender</label>
        <div class="div-center">
            <label for="male">Male</label>
            <input type="radio" id="male" name="gender" value="male" <?= $gender == "male" ? "checked" : "" ?>>

            <label for="female">Female</label>
            <input type="radio" id="female" name="gender" value="female" <?= $gender == "female" ? "checked" : "" ?>>
        </div>
        <hr>

        <label for="">Enrollment Date</label>
        <input type="date" name="enrollment_date" value="<?= $enrollment_date ?>" placeholder="Enter Enrollment Date">

        <input type="submit" name="update" value="Update">
    </form>
</body>

</html>