<?php
    require_once("pkg_catering_model.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add pkg photo video</title>
</head>
<body>
    <a href="pkg_catering_overview.php">Back</a>
    <form action="pkg_catering_model.php" method="post">
        <table>
            <tr>
                <td>Package Name</td>
                <td><input type="text" name="package_name"></td>
            </tr>
            <tr>
                <td>qty_persons</td>
                <td><input type="text" name="qty_persons"></td>
            </tr>
            <tr>
                <td>qty_type_main_course</td>
                <td><input type="text" name="qty_type_main_course"></td>
            </tr>
            <tr>
                <td>qty_type_dessert</td>
                <td><input type="text" name="qty_type_dessert"></td>
            </tr>
        </table>
    <input type="submit" name="addDataSubmit" value="Save">
    </form>
</body>
</html>