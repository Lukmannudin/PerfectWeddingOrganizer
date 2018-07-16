    <?php 
        require("../database.php");
        
    
        if (isset($_GET['id_payment'])) {
            $id_payment = $_GET['id_payment'];
            if (isset($_GET['method'])) {
                if (($_GET['method']) == "edit") {
                    editPayment($id_payment);
                } elseif (($_GET['method']) == "delete") {
                    deletePayment($id_payment);
                }
            }
        }

        if (isset($_POST['saveDataSubmit'])) {
            addDataPayment();
        }

        if (isset($_POST['search'])) {
            if (isset($_POST['category']) && isset($_POST['input_search']) && isset($_POST['input_search']) != '') {
                $category = $_POST['category'];
                $input_search = $_POST['input_search'];   
                $hasil_search = search($category,$input_search);       
                return $hasil_search;
            }
        }

        function addDataPayment(){
        $link = getLinkDatabase();
            
            $bank_name = secure_input($_POST['bank_name']);
                $down_payment = secure_input($_POST['down_payment']);
                $status = secure_input($_POST['status']);
                $total_price = secure_input($_POST['total_price']);  
                  

                $bankNameErr = bankNameValidation($bank_name);
                $downPaymentErr = downPaymentValidation($down_payment);
                $statusErr = statusValidation($status);
                $totalPriceErr = totalPriceValidation($total_price);
               

                
                if ( ($bankNameErr=="") && ($downPaymentErr=="") && ($statusErr=="") && ($total_priceErr=="") ) {
                    $data = array(
                            'bank_name' => $bank_name,
                            'down_payment' => $down_payment,
                            'status' => $status,
                            'total_price' => $total_price                        
                        );
                    saveDataPayment($link,$data);
                } else {
                    include 'payment_add.php';
                }
                
            
        }
        
        
        function getLinkDatabase(){
            return koneksi_db();  
        }

        function selectAllPayment(){
            $sql = 'SELECT * FROM `payments`';
            $res = mysqli_query(getLinkDatabase(),$sql);
            return $res;
        }

        function editPayment($id_payment){
            $sql = "";
            $data = array();
            $link = getLinkDatabase();
            $sql = "SELECT * FROM payments WHERE id_payment='$id_payment'";
            
            $res = mysqli_query($link,$sql);
            if (mysqli_num_rows($res) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($res)) {
                    $data = array (
                        "id_payment" => $row['id_payment'],
                        "bank_name" => $row['bank_name'],
                        "down_payment" => $row['down_payment'],
                        "status" => $row['status'],
                        "total_price" => $row['total_price']                        
                    );
                }       
            }    

            
            
            include("payment_edit.php");
            if (isset($_POST['updateDataSubmit'])) {
                $data_update = array(
                    "id_payment" => $data['id_payment'],
                    "bank_name" => secure_input($_POST['bank_name']),
                    "down_payment" => secure_input($_POST['down_payment']),
                    "status" => secure_input($_POST['status']),
                    "total_price" => secure_input($_POST['total_price'])                   
                );

                $bankNameErr = bankNameValidation($_POST['bank_name']);
                $downPaymentErr = downPaymentValidation($_POST['down_payment']);
                $statusErr = statusValidation($_POST['status']);
                $totalPriceErr = totalPriceValidation($_POST['total_price']);
                if ( ($bankNameErr=="") && ($downPaymentErr=="") && ($statusErr=="") && ($total_priceErr=="") ) {
                    $sql = "UPDATE `payment` 
                        SET 
                        `bank_name` = '$data_update[bank_name]', 
                        `down_payment` = '$data_update[down_payment]', 
                        `status` = '$data_update[status]',
                        `total_price` = '$data_update[total_price]' 
                        WHERE `payment`.`id_payment` = $id_payment";
                
                    $res = mysqli_query($link,$sql);
                        if ($res) {
                            header('Location: payment.php');
                        } else {
                            "<h1> Failed to update data </h1>";
                    }
                }else {
                    echo $bankNameErr.'<br>';
                    echo $downPaymentErr.'<br>';
                    echo $statusErr.'<br>';
                    echo $totalPriceErr.'<br>';
                }
            } 
        }


        function search($category,$search){
            $link = getLinkDatabase();
            $sql = "SELECT * FROM payment WHERE $category LIKE '%$search%'";
            $res = mysqli_query($link,$sql);
            
            if ($res->num_rows > 0) {
                return $res;
            } else {
                return $res;
            }
        }

        // function saveData

        function saveDataPayment($link,$data){
            $sql = "INSERT INTO `payment` 
            (`id_payment`, `down_payment`, `bank_name`, `status`,`total_price`) 
            VALUES (NULL, '$data[down_payment]', '$data[bank_name]', '$data[status]', '$data[total_price]')";
            $res = mysqli_query($link,$sql);
            if ($res) {
                header('Location: payment.php');
            } else {
                header('Location: payment_add.php');
            }
        }

        function deletePayment($id){
            $sql = "DELETE FROM `payment` WHERE `payment`.`id_payment` = '$id'";
            $res = mysqli_query(getLinkDatabase(),$sql);
            header('Location: payment.php');
            
        }

        function secure_input($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
        
    

        function bankNameValidation($venueData){
            if (empty($venueData)) {
                $bankNameErr = "Bank Name is required";
            } else {
                $bankNameErr = "";
            }
            return $bankNameErr;
        }

        function downPaymentValidation($down_payment){
            if (empty($down_payment)){
                $downPaymentErr = "Down Payment is required";
            } elseif(!is_numeric($down_payment)) {
                $downPaymentErr = "Down Payment accepts only number";
            } else {
                $downPaymentErr = "";
            }
            return $downPaymentErr;
        }

        function totalPriceValidation($total_price){
            if (empty($total_price)){
                $totalPriceErr = "Total Price is required";
            } elseif(!is_numeric($total_price)) {
                $totalPriceErr = "Total Price accepts only number";
            } else {
                $totalPriceErr = "";
            }
            return $totalPriceErr;
        }

        function statusValidation($status){
            $statusErr="";
                if (empty($status)) {
                    $statusErr = "Status  is required";
                } elseif (!is_numeric($status)) {
                    $statusErr = "Status invalid input format";
                } elseif (($status == 0) and ($status==1)) {
                    $totalPriceErr = "Status not must be on or off";
                } else {
                    $statusErr = "";
                }
    
    
                return $statusErr;
            }
            
               
    ?>         