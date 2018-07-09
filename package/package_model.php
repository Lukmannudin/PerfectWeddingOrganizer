<?php 
    require_once("../database.php");


    //get Link
    function getLinkDatabase() {
        return koneksi_db();  
    }

    index();
    if (isset($_POST['addDataSubmit'])) {
        addPackage();
    } 
    
    if (isset($_GET['id_package'])) {
        $id_package = $_GET['id_package'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updatePackage($id_package);
            } elseif (($_GET['method']) == "delete") {
                deletePackage($id_package);
            }
        }
    }

    function index() {
        $packageErr             = "";
        $package_priceErr       = "";
        $qty_WO_personilErr     = "";
        $id_pkg_photo_videoErr  = "";
        $id_pkg_musicErr        = "";
        $id_pkg_cateringErr     = "";

        $package_name       = secure_input($_POST['package_name']);
        $package_price      = secure_input($_POST['package_price']);
        $qty_WO_personil    = secure_input($_POST['qty_WO_personil']);
        $id_pkg_photo_video = secure_input($_POST['id_pkg_photo_video']);
        $id_pkg_music       = secure_input($_POST['id_pkg_music']);
        $id_pkg_catering    = secure_input($_POST['id_pkg_catering']);

    }

    function selectPPV($id) {
        $link = getLinkDatabase();
        if ($id == 0) {
            $sqlPPV = "SELECT * FROM pkg_photo_video";
        } else {
            $sqlPPV = "SELECT * FROM pkg_photo_video WHERE id_pkg_photo_video = '$id'";
        } 
        $resPPV = mysqli_query($link,$sqlPPV);
        return $resPPV;
    }

    function selectMusic($id) {
        $link = getLinkDatabase();
        if ($id == 0) {
            $sqlMusic = "SELECT * FROM pkg_music";
        } else {
            $sqlMusic = "SELECT * FROM pkg_music WHERE id_pkg_music = '$id'";
        }
        $resMusic = mysqli_query($link,$sqlMusic);
        return $resMusic;
    }

    function selectCatering($id) {
        $link = getLinkDatabase();
        if ($id == 0) {
            $sqlCatering = "SELECT * FROM pkg_catering";
        } else {
            $sqlCatering = "SELECT * FROM pkg_catering WHERE id_pkg_catering = '$id'"; 
        } 
        $resCatering = mysqli_query($link,$sqlCatering);
        return $resCatering;
    }

    function selectAllPackage() {
        $link = getLinkDatabase();
        $sql = "SELECT * FROM package";
        $res = mysqli_query($link,$sql);
        return $res;
    }
 
    function addPackage() {
        $link = getLinkDatabase();

        $package_name       = $_POST['package_name'];
        $package_price      = $_POST['package_price'];
        $qty_wo_personil    = $_POST['qty_wo_personil'];
        $id_pkg_photo_video = $_POST['id_pkg_photo_video'];
        $id_pkg_music       = $_POST['id_pkg_music'];
        $id_pkg_catering    = $_POST['id_pkg_catering'];
        
        echo $id_pkg_photo_video;
        echo $id_pkg_music;
        echo $id_pkg_catering;
        
        $sql = "insert into package values (null ,'$package_name',$package_price,'$qty_wo_personil',$id_pkg_photo_video,$id_pkg_music,$id_pkg_catering)";
        $res = mysqli_query($link,$sql);

        if($res){
            header('location: package_overview.php');
        }else{
            echo "Tambah data gagal";
        }
    }

    function updatePackage($id_package) {
        $data = array();
        $data_update = array();
        $link = getLinkDatabase();
        $sql = "SELECT * FROM package WHERE id_package='$id_package'";
        $res = mysqli_query($link,$sql);
        $data=mysqli_fetch_array($res);
        
        $id_PV = $data['id_pkg_photo_video'];
        $id_music = $data['id_pkg_music'];
        $id_catering = $data['id_pkg_catering'];

        $resPPV = selectPPV($id_PV);
        $resMusic = selectMusic($id_music);
        $resCatering = selectCatering($id_catering);

        $dataPPV = mysqli_fetch_array($resPPV);
        $dataMusic = mysqli_fetch_array($resMusic);
        $dataCatering = mysqli_fetch_array($resCatering);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "id_package"         => $row['id_package'],
                    "package_name"       => $row['package_name'],
                    "package_price"      => $row['package_price'],
                    "qty_WO_personil"    => $row['qty_WO_personil'],
                    "name_pkg_photo_video" => $dataPPV['package_name'],
                    "name_pkg_music"       => $dataMusic['package_name'],
                    "name_pkg_catering"    => $dataCatering['package_name']
                );
            }
        }

        $selected = $dataPPV['id_pkg_photo_video'];
        $res = false;
        
        include("package_update.php");
        if (isset($_POST['updateDataSubmit'])) {
            $data_update = array (
                "id_package"         => $data['id_package'],
                "package_name"       => $_POST['package_name'],
                "package_price"      => $_POST['package_price'],
                "qty_WO_personil"    => $_POST['qty_WO_personil'],
                "id_pkg_photo_video" => $_POST['id_pkg_photo_video'],
                "id_pkg_music"       => $_POST['id_pkg_music'],
                "id_pkg_catering"    => $_POST['id_pkg_catering']
            );
            
            $sql = "UPDATE `package` 
                    SET 
                    package_name        = '$data_update[package_name]',
                    package_price       = '$data_update[package_price]',
                    qty_WO_personil     = '$data_update[qty_WO_personil]',
                    id_pkg_photo_video  = '$data_update[id_pkg_photo_video]',
                    id_pkg_music        = '$data_update[id_pkg_music]',
                    id_pkg_catering     = '$data_update[id_pkg_catering]'
                    WHERE package.id_package = $id_package";
            
            //echo  $id_package;
            echo $data['id_package'];
            echo $data_update['package_name'];
            echo $data_update['package_price'];
            echo $data_update['qty_WO_personil'];
            echo $data_update['id_pkg_photo_video'];
            echo $data_update['id_pkg_music'];
            echo $data_update['id_pkg_catering'];
            
            $res = mysqli_query($link,$sql);

            if($res){
                header('location: package_overview.php');
            }else{
                echo "Tambah data gagal";
            }
        }
    }

    function deletePackage($id) {
        $sql = "DELETE FROM package where id_package = '$id'";
        $link = getLinkDatabase();
        $res = mysqli_query($link,$sql);
        header('location:package_overview.php');
    }

    //Validasi Input Data
    $packageErr             = packageValidation($package_name);
    $package_priceErr       = package_priceValidation($package_price);
    $qty_WO_personilErr     = qty_WO_personilValidation($qty_WO_personil);
    $id_pkg_photo_videoErr  = id_pkg_photo_videoValidation($id_pkg_photo_video);
    $id_pkg_musicErr        = id_pkg_musicValidation($id_pkg_music);
    $id_pkg_cateringErr     = id_pkg_cateringValidation($id_pkg_catering);
    
    function secure_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

    function packageValidation($package_name) {
        if (empty($package_name)) {
            $packageErr = "Package Name is required";
        } 
        return $packageErr;
    }

    function package_priceValidation($package_price) {
        if (empty($package_price)){
            $package_priceErr = "Package price is required";
        } elseif(!is_numeric($package_price)) {
            $package_priceErr = "Package price accepts only number";
        }
        return $package_priceErr;
    }

    function qty_WO_personilValidation($qty_WO_personil) {
        if (empty($qty_WO_personil)){
            $qty_WO_personilErr = "qty WO personil is required";
        } elseif(!is_numeric($qty_WO_personil)) {
            $qty_WO_personilErr = "qty WO personil accepts only number";
        }
        return $qty_WO_personilErr;
    }

    function id_pkg_photo_videoValidation($id_pkg_photo_video) {
        if (empty($id_pkg_photo_video)){
            $id_pkg_photo_videoErr = "Package photo video is required";
        } elseif(!is_numeric($id_pkg_photo_video)) {
            $id_pkg_photo_videoErr = "ID package photo video only number";
        }
        return $id_pkg_photo_videoErr;
    }

    function id_pkg_musicValidation($id_pkg_music) {
        if (empty($id_pkg_music)){
            $id_pkg_musicErr = "Package music is required";
        } elseif(!is_numeric($id_pkg_music)) {
            $id_pkg_musicErr = "ID package accepts only number";
        }
        return $id_pkg_musicErr;
    }

    function id_pkg_cateringValidation($id_pkg_catering) {
        if (empty($id_pkg_catering)){
            $id_pkg_cateringErr = "Package catering is required";
        } elseif(!is_numeric($id_pkg_catering)) {
            $id_pkg_cateringErr = "ID package Max capacity accepts only number";
        }
        return $id_pkg_cateringErr;
    }
?>