<?php
    require_once("package_model.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Package Overview</title>
</head>
<body>
    <center>
        <a href="package_add.php">ADD</a> <a href="venue_delete"></a>
        <table border=1>
            <tr>
                <td>No</td>
                <td>Package Name</td>
                <td>Price</td>
                <td>WO Personil</td>
                <td>Pkg Photo & Video</td>
                <td>Pkg Music</td>
                <td>Pkg Catering</td>
            </tr>

            <?php
               $no=0;
               $res = selectAllPackage();
               $ketemu = mysqli_num_rows($res);
       
               if ($ketemu > 0) {
                   while ($data=mysqli_fetch_array($res)) {
       
                       $id_PV = $data['id_pkg_photo_video'];
                       $id_music = $data['id_pkg_music'];
                       $id_catering = $data['id_pkg_catering'];
       
                       $resPPV = selectPPV($id_PV);
                       $resMusic = selectMusic($id_music);
                       $resCatering = selectCatering($id_catering);
        
                       $dataPPV = mysqli_fetch_array($resPPV);
                       $dataMusic = mysqli_fetch_array($resMusic);
                       $dataCatering = mysqli_fetch_array($resCatering);
       
                       $no++;
           ?>
                       <tr>
                           <td> <a href="package_model.php?id_package=<?php echo $data['id_package'] ?>&method=edit"> <?php echo $no ?> </td>
                           <td> <?php echo $data['package_name'] ?> </td>
                           <td> <?php echo $data['package_price'] ?> </td>
                           <td> <?php echo $data['qty_WO_personil'] ?> </td>
                           <td> <?php echo $dataPPV['package_name'] ?> </td>
                           <td> <?php echo $dataMusic['package_name'] ?> </td>
                           <td> <?php echo $dataCatering['package_name'] ?> </td>
                           <td><a href="package_model.php?id_package=<?php echo $data['id_package'] ?>&method=delete">Delete</a></td>
                       </tr>
            <?php 
                }
            } else {
                echo "0 results";
            }
            ?>
        </table>
    </center>
</body>
</html>