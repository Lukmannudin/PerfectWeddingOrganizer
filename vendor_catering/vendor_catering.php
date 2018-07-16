<?php
    require 'vendor_catering_model.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="vendor_catering_add.php">ADD</a> <a href="venue_delete"></a>
    <form action="" method='post'>
        <select name="category" id="">
            <option value="name">Customer Name</option>
            <option value="phone_number">Phone Number</option>
            <option value="address">Address</option>
            <option value="availability">Availability</option>

        </select>
        Search<input type="text" name="input_search">
        <input type="submit" value="Search" name="search">
    </form>
    <table>
        <tr>
            <td>No</td>
            <td>Name</td>
            <td>Phone Number</td>
            <td>Address</td>
            <td>Availability</td>        
        </tr>
        <?php
            $no=1; 
            if (isset($hasil_search)) {
                $res = $hasil_search;
            } else {
           $res =  selectAllVendorCatering();
                
             }
           if (mysqli_num_rows($res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($res)) {
                 ?>     
            <tr>
                <td><a href="vendor_catering_model.php?id_vendor_catering=<?php echo $row['id_vendor_catering'] ?>&method=edit"><?php echo $no ?></a></td>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["phone_number"] ?></td>
                <td><?php echo $row["address"] ?></td>   
                <td><?php echo $row["availability"] ?></td>              
                <td><a href="vendor_catering_model.php?id_vendor_catering=<?php echo $row['id_vendor_catering'] ?>&method=delete">Delete</a></td>
            </tr>

            <?php    
            $no++;
            }
        } else {
            echo "0 results";
        }
   ?>
    </table>
</body>
</html>