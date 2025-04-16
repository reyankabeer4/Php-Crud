<?php

include "config.php";

if (isset($_POST['create'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $batch = $_POST['batch'];

    // Image Upload
    $image = $_FILES['image']["tmp_name"];
    $imageName = $_FILES['image']["name"];
    move_uploaded_file($image, './stdImages/' . $imageName);

    $contact = $_POST['contact'];
    $subject = isset($_POST['subject']) ? implode(",", $_POST['subject']) : '';
    $gender = $_POST['gender'];
    $enrollment_date = $_POST['enrollment_date'];

    $stmt = mysqli_prepare($conn, "INSERT INTO STUDENTS (name,email,batch,image,contact,subject,gender,enrollment_date) VALUES (?,?,?,?,?,?,?,?)");

    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $batch, $imageName, $contact, $subject, $gender, $enrollment_date);

    mysqli_execute($stmt) or die("Sql query failed");



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
    <h1>Create Page</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Name</label>
        <input type="text" name="name" placeholder="Enter Name">
        <label for="">Email</label>
        <input type="text" name="email" placeholder="Enter Email">
        <label for="">Batch</label>
        <input type="text" name="batch" placeholder="Enter Batch">
        <label for="">Image</label>
        <input type="file" name="image">
        <label for="">Contact</label>
        <input type="text" name="contact" placeholder="Enter Contact">
        <label for="">Subjects</label>
        <hr>
        <div class="div-center">
            <label for="chemistry">Chemistry</label>
            <input type="checkbox" id="chemistry" name="subject[]" value="chemistry" placeholder="Enter Subject">

            <label for="maths">Maths</label>
            <input type="checkbox" id="maths" name="subject[]" value="maths" placeholder="Enter Subject">

            <label for="physics">Physics</label>
            <input type="checkbox" id="physics" name="subject[]" value="physics" placeholder="Enter Subject">

            <label for="computer">Computer</label>
            <input type="checkbox" id="computer" name="subject[]" value="computer" placeholder="Enter Subject">
        </div>

        <hr>
        <label for="">Select Gender</label>
        <div class="div-center">
            <label for="male">Male</label>
            <input type="radio" id="male" name="gender" value="male" placeholder="Enter Gender">
        </div>
        <div>
            <label for="female">Female</label>
            <input type="radio" id="female" name="gender" value="Female" placeholder="Enter Gender">
        </div>
        <hr>

        <label for="">Enrollment Date</label>
        <input type="date" name="enrollment_date" placeholder="Enter Enrollment Date">

        <input type="submit" name="create" value="Create">
    </form>
    <!--  -->


</body>

</html>