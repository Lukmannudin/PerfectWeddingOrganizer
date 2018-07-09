<?php
    require_once("pkg_catering_model.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update pkg catering</title>
</head>
<body>
    <a href="pkg_catering_overview.php">Back</a>
    <form action="" method="post">
        <table>
            <tr>
                <td>Package Name</td>
                <td><input type="text" name="package_name"  value="<?php echo $data['package_name']?>"></td>
            </tr>
            <tr>
                <td>qty_persons</td>
                <td><input type="text" name="qty_persons" value="<?php echo $data['qty_persons']?>"></td>
            </tr>
            <tr>
                <td>qty_type_main_course</td>
                <td><input type="text" name="qty_type_main_course" value="<?php echo $data['qty_type_main_course']?>"></td>
            </tr>
            <tr>
                <td>qty_type_dessert</td>
                <td><input type="text" name="qty_type_dessert" value="<?php echo $data['qty_type_dessert']?>"></td>
            </tr>
        </table>
    <input type="submit" name="updateDataSubmit" value="Save">
    </form>
</body>
</html>