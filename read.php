<?php
include "config.php";

$sql = "SELECT * FROM STUDENTS";
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);

$output = "";

if ($rows > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
            <td>{$data["id"]}</td>
            <td>{$data["name"]}</td>
            <td>{$data["email"]}</td>
            <td>{$data["batch"]}</td>
            <td><img src='./stdImages/{$data["image"]}' height='50' alt='{$data["name"]}'></td>
            <td>{$data["contact"]}</td>
            <td>{$data["subject"]}</td>
            <td>{$data["gender"]}</td>
            <td>{$data["enrollment_date"]}</td>
            <td class='btns'>
                <a href='edit.php?id={$data["id"]}' class='edit-btn'>Edit</a>
    
                <form action='delete.php' method='POST' style='width: auto' onsubmit=\"return confirm('Are you sure you want to delete this student?');\" style='display:inline-block;'>
                    <input type='hidden' name='id' value='{$data['id']}'>
                    <button type='submit' class='del-btn'>Delete</button>
                </form>
            </td>
        </tr>";
    }

} else {
    $output = "<tr><td colspan='10'>No records found</td></tr>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Student Records</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Batch</th>
                <th>Image</th>
                <th>Contact</th>
                <th>Subjects</th>
                <th>Gender</th>
                <th>Enrollment Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $output ?>
        </tbody>
    </table>
</body>

</html>