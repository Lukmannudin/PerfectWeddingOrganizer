<?php
    require_once("pkg_photo_video_model.php");
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
    <a href="pkg_photo_video_overview.php">Back</a>
    <form action="pkg_photo_video_model.php" method="post">
        <table>
            <tr>
                <td>Package Name</td>
                <td><input type="text" name="package_name"></td>
            </tr>
            <tr>
                <td>Duration prewedding</td>
                <td><input type="text" name="duration_prewedding"></td>
            </tr>
            <tr>
                <td>Qty Album</td>
                <td><input type="text" name="qty_album"></td>
            </tr>
            <tr>
                <td>Photo album size</td>
                <td><input type="text" name="photo_album_size"></td>
            </tr>
            <tr>
                <td>Qty gallery</td>
                <td><input type="text" name="qty_gallery"></td>
            </tr>
            <tr>
                <td>Photo gallery size</td>
                <td><input type="text" name="photo_gallery_size"></td>
            </tr>
        </table>
    <input type="submit" name="addDataSubmit" value="Save">
    </form>
</body>
</html>