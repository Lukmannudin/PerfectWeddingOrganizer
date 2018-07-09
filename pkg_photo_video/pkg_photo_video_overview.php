<?php
    include_once ('pkg_photo_video_model.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Package photo video Overview</title>
</head>
<body>
    <center>
        <a href="pkg_photo_video_add.php">ADD</a> <a href="venue_delete"></a>
        <table border=1>
            <tr>
                <td>No</td>
                <td>Pacakge name</td>
                <td>Duration prewedding</td>
                <td>Qty Album</td>
                <td>Photo album size</td>
                <td>Qty gallery</td>
                <td>Photo gallery size</td>
            </tr>

            <?php
                $no=0;
                $res = selectAllPVV();
                $ketemu = mysqli_num_rows($res);

                if ($ketemu > 0) {
                    while ($data=mysqli_fetch_array($res)) {
                        $no++;
            ?>
                        <tr>
                            <td> <a href="pkg_photo_video_model.php?id_pkg_photo_video=<?php echo $data['id_pkg_photo_video'] ?>&method=edit"> <?php echo $no ?> </td>
                            <td> <?php echo $data['package_name'] ?></td>
                            <td> <?php echo $data['duration_prewedding'] ?></td>
                            <td> <?php echo $data['qty_album'] ?></td>
                            <td> <?php echo $data['photo_album_size'] ?></td>
                            <td> <?php echo $data['qty_gallery'] ?></td>
                            <td> <?php echo $data['photo_gallery_size'] ?></td>
                            <td> <a href="pkg_photo_video_model.php?id_pkg_photo_video=<?php echo $data['id_pkg_photo_video'] ?>&method=delete">Delete</a></td>
                        </tr>
            <?php
                    }
                } else {
                    echo "0 results";
                }

            ?>
        </table>
</body>
</html>