<?php
    include_once ('pkg_music_model.php')

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
        <a href="pkg_music_add.php">ADD</a> <a href="venue_delete"></a>
        <table border=1>
            <tr>
                <td>No</td>
                <td>Pacakge name</td>
                <td>Qty Piano</td>
                <td>Qty Saxophone</td>
                <td>Qty Biola</td>
                <td>Qty bass</td>
                <td>Sound System</td>
            </tr>

            <?php
                $no=0;
                $res = selectAllpkgMusic();
                $ketemu = mysqli_num_rows($res);

                if ($ketemu > 0) {
                    while ($data=mysqli_fetch_array($res)) {
                        $no++;
            ?>
                        <tr>
                            <td> <a href="pkg_music_model.php?id_pkg_music=<?php echo $data['id_pkg_music'] ?>&method=edit"> <?php echo $no ?> </td>
                            <td> <?php echo $data['package_name'] ?></td>
                            <td> <?php echo $data['qty_vocal'] ?></td>
                            <td> <?php echo $data['qty_piano'] ?></td>
                            <td> <?php echo $data['qty_saxophone'] ?></td>
                            <td> <?php echo $data['qty_biola'] ?></td>
                            <td> <?php echo $data['qty_bass'] ?></td>
                            <td> <?php echo $data['sound_system'] ?></td>
                            <td> <a href="pkg_music_model.php?id_pkg_music=<?php echo $data['id_pkg_music'] ?>&method=delete">Delete</a></td>
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