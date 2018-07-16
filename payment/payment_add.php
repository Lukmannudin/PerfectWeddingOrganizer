<?php 
if ( (isset($bankNameErr)) || (isset($downPaymentErr)) || (isset($statusPaymentErr)) || (isset($statusPaymentErr))) {
    echo $bankNameErr."<br>";
    echo $downPaymentErr."<br>";
    echo $totalPriceErr."<br>";
    echo $statusErr."<br>";
}
    
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
<a href="payment.php">Back</a>
    <form action="payment_model.php" method="post">
    <table>
        <tr>
            <td>Bank Name</td>
            <td><input type="text" name="bank_name" id=""></td>
        </tr>
        <tr>
            <td>Down Payment</td>
            <td><input type="text" name="down_payment" id=""></td>
        </tr>        
        <tr>
            <td>Total Price</td>
            <td><input type="text" name="total_price" id=""></td>
        </tr>  
        <tr>
            <td>
                ON<input type="radio" name="status" id="" value="1" checked>
                OFF<input type="radio" name="status" id="" value="0">
            </td>
        </tr>    
          
    </table>
    <input type="submit" name="saveDataSubmit" value="Save">
    </form>
</body>
</html>   