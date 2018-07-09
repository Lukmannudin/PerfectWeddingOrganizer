<?php
    require_once("../database.php");

    function getLinkDatabase() {
        return koneksi_db();  
    }

    if (isset($_POST['addDataSubmit'])) {
        addPkgcatering();
    }

    if (isset($_GET['id_pkg_catering'])) {
        $id_pkg_catering = $_GET['id_pkg_catering'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updatePkgCatering($id_pkg_catering);
            } elseif (($_GET['method']) == "delete") {
                deletePkgCatering($id_pkg_catering);
            }
        }
    }

    function selectAllpkgCatering() {
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_catering";
        $res = mysqli_query($link,$sql);
        return $res;
    }

    function addPkgCatering() {
        $link = getLinkDatabase();

        $package_name           = $_POST['package_name'];
        $qty_persons            = $_POST['qty_persons'];
        $qty_type_main_course   = $_POST['qty_type_main_course'];
        $qty_type_dessert       = $_POST['qty_type_dessert'];

        $sql = "INSERT INTO pkg_catering values (null, '$package_name','$qty_persons','$qty_type_main_course','$qty_type_dessert')";
        $res = mysqli_query($link,$sql);

        if($res){
            header('location: pkg_catering_overview.php');
        }else{
            echo "Tambah data gagal";
        }
    }

    function updatePkgCatering($id_package) {
        $data = array();
        $data_update = array();
        $link = getLinkDatabase();

        $sql = "SELECT * FROM pkg_catering WHERE id_pkg_catering='$id_package'";
        $res = mysqli_query($link,$sql);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "package_name"           => $row['package_name'],
                    "qty_persons"            => $row['qty_persons'],
                    "qty_type_main_course"   => $row['qty_type_main_course'],
                    "qty_type_dessert"       => $row['qty_type_dessert']
                );
            }
        }

        include("pkg_catering_update.php");
        if (isset($_POST['updateDataSubmit'])) {
            echo "h";
            $data_update = array (
                "package_name"           => $_POST['package_name'],
                "qty_persons"            => $_POST['qty_persons'],
                "qty_type_main_course"   => $_POST['qty_type_main_course'],
                "qty_type_dessert"       => $_POST['qty_type_dessert']
            );
        
        
        $sql = "UPDATE pkg_catering
                SET
                package_name            = '$data_update[package_name]',
                qty_persons             = '$data_update[qty_persons]',
                qty_type_main_course    = '$data_update[qty_type_main_course]',
                qty_type_dessert        = '$data_update[qty_type_dessert]'
                WHERE pkg_catering.id_pkg_catering = $id_package";

            $res = mysqli_query($link,$sql);

            if($res){
                header('location: pkg_catering_overview.php');
            }else{
                echo "Tambah data gagal";
            }
        }
    }

    function deletePkgCatering($id) {
        $sql = "DELETE FROM pkg_catering where id_pkg_catering = '$id'";
        $link = getLinkDatabase();
        $res = mysqli_query($link,$sql);
        if($res){
            header('location:pkg_catering_overview.php');
        }else{
            echo "Tambah data gagal";
        }
    }
?>