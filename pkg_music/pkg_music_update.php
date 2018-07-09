<?php
    require_once("pkg_music_model.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update pkg music</title>
</head>
<body>
    <a href="pkg_music_overview.php">Back</a>
    <form action="" method="post">
        <table>
            <tr>
                <td>Package Name</td>
                <td><input type="text" name="package_name"  value="<?php echo $data['package_name']?>"></td>
            </tr>
            <tr>
                <td>qty vocal</td>
                <td><input type="text" name="qty_vocal" value="<?php echo $data['qty_vocal']?>"></td>
            </tr>
            <tr>
                <td>qty piano</td>
                <td><input type="text" name="qty_piano" value="<?php echo $data['qty_piano']?>"></td>
            </tr>
            <tr>
                <td>qty_saxophone</td>
                <td><input type="text" name="qty_saxophone" value="<?php echo $data['qty_saxophone']?>"></td>
            </tr>
            <tr>
                <td>qty_biola</td>
                <td><input type="text" name="qty_biola" value="<?php echo $data['qty_biola']?>"></td>
            </tr>
            <tr>
                <td>qty_bass</td>
                <td><input type="text" name="qty_bass" value="<?php echo $data['qty_bass']?>"></td>
            </tr>
            <tr>
                <td>sound_system</td>
                <td><input type="text" name="sound_system" value="<?php echo $data['sound_system']?>"></td>
            </tr>
        </table>
    <input type="submit" name="updateDataSubmit" value="Save">
    </form>
</body>
</html>