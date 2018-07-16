<?php
    require 'payment_model.php';
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
    <a href="payment_add.php">ADD</a> <a href="payment_delete"></a>
    <form action="" method='post'>
        <select name="category" id="">
            <option value="bank_name">Bank Name</option>
            <option value="down_payment">Down Payment</option>
            <option value="status">Status Payment</option>
            <option value="total_price">Total Price</option>
        </select>
        Search<input type="text" name="input_search">
        <input type="submit" value="Search" name="search">
    </form>
    <table>
        <tr>
            <td>No</td>
            <td>Bank Name</td>
            <td>Down Payment</td>
            <td>Status Payment</td>
            <td>Total Price</td>        
        </tr>
        <?php
            $no=1; 
            if (isset($hasil_search)) {
                $res = $hasil_search;
            } else {
                $res =  selectAllPayment();
             }
          
           if (mysqli_num_rows($res) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($res)) {
                 ?>     
            <tr>
                <td><a href="payment_model.php?id_payment=<?php echo $row['id_payment'] ?>&method=edit"><?php echo $no ?></a></td>
                <td><?php echo $row["bank_name"] ?></td>
                <td><?php echo $row["down_payment"] ?></td>
                <td><?php echo $row["status"] ?></td>           
                <td><?php echo $row["total_price"] ?></td>   
                <td><a href="payment_model.php?id_payment=<?php echo $row['id_payment'] ?>&method=delete">Delete</a></td>
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