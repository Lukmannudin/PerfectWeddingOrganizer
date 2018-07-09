<?php
    include_once ('pkg_catering_model.php')

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
        <a href="pkg_catering_add.php">ADD</a> <a href="venue_delete"></a>
        <table border=1>
            <tr>
                <td>No</td>
                <td>Pacakge name</td>
                <td>Qty Person</td>
                <td>Qty Type Main Course</td>
                <td>Qty Type Dessert</td>
            </tr>

            <?php
                $no=0;
                $res = selectAllpkgCatering();
                $ketemu = mysqli_num_rows($res);

                if ($ketemu > 0) {
                    while ($data=mysqli_fetch_array($res)) {
                        $no++;
            ?>
                        <tr>
                            <td> <a href="pkg_catering_model.php?id_pkg_catering=<?php echo $data['id_pkg_catering'] ?>&method=edit"> <?php echo $no ?> </td>
                            <td> <?php echo $data['package_name'] ?></td>
                            <td> <?php echo $data['qty_persons'] ?></td>
                            <td> <?php echo $data['qty_type_main_course'] ?></td>
                            <td> <?php echo $data['qty_type_dessert'] ?></td>
                            <td> <a href="pkg_catering_model.php?id_pkg_catering=<?php echo $data['id_pkg_catering'] ?>&method=delete">Delete</a></td>
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