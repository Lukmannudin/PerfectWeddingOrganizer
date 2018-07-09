<?php
    require_once("../database.php");

    function getLinkDatabase() {
        return koneksi_db();  
    }

    if (isset($_POST['addDataSubmit'])) {
        addPPV();
    }

    if (isset($_GET['id_pkg_photo_video'])) {
        $id_pkg_photo_video = $_GET['id_pkg_photo_video'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updatePPV($id_pkg_photo_video);
            } elseif (($_GET['method']) == "delete") {
                echo "m";
                deletePPV($id_pkg_photo_video);
            }
        }
    }

    function selectAllPVV() {
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_photo_video";
        $res = mysqli_query($link,$sql);
        return $res;
    }

    function addPPV() {
        $link = getLinkDatabase();

        $package_name           = $_POST['package_name'];
        $duration_prewedding    = $_POST['duration_prewedding'];
        $qty_album              = $_POST['qty_album'];
        $photo_album_size       = $_POST['photo_album_size'];
        $qty_gallery            = $_POST['qty_gallery'];
        $photo_gallery_size     = $_POST['photo_gallery_size'];

        $sql = "INSERT INTO pkg_photo_video values (null, '$package_name','$duration_prewedding','$qty_album ','$photo_album_size','$qty_gallery','$photo_gallery_size')";
        $res = mysqli_query($link,$sql);

        if($res){
            header('location: pkg_photo_video_overview.php');
        }else{
            echo "Tambah data gagal";
        }
    }

    function updatePPV($id_package) {
        $data = array();
        $data_update = array();
        $link = getLinkDatabase();

        $sql = "SELECT * FROM pkg_photo_video WHERE id_pkg_photo_video='$id_package'";
        $res = mysqli_query($link,$sql);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "id_pkg_photo_video"    => $row['id_pkg_photo_video'],
                    "package_name"          => $row['package_name'],
                    "duration_prewedding"   => $row['duration_prewedding'],
                    "qty_album"             => $row['qty_album'],
                    "photo_album_size"      => $row['photo_album_size'],
                    "qty_gallery"           => $row['qty_gallery'],
                    "photo_gallery_size"    => $row['photo_gallery_size']
                );
            }
        }

        include("pkg_photo_video_update.php");

        if (isset($_POST['updateDataSubmit'])) {
            echo "nah";
            $data_update = array (
                "id_pkg_photo_video"    => $data['id_pkg_photo_video'],
                "package_name"          => $_POST['package_name'],
                "duration_prewedding"   => $_POST['duration_prewedding'],
                "qty_album"             => $_POST['qty_album'],
                "photo_album_size"      => $_POST['photo_album_size'],
                "qty_gallery"           => $_POST['qty_gallery'],
                "photo_gallery_size"    => $_POST['photo_gallery_size']
            );
        
        
        $sql = "UPDATE pkg_photo_video
                SET
                package_name          = '$data_update[package_name]',
                duration_prewedding   = '$data_update[duration_prewedding]',
                qty_album             = '$data_update[qty_album]',
                photo_album_size      = '$data_update[photo_album_size]',
                qty_gallery           = '$data_update[qty_gallery]',
                photo_gallery_size    = '$data_update[photo_gallery_size]'
                WHERE pkg_photo_video.id_pkg_photo_video = $id_package";

            $res = mysqli_query($link,$sql);

            if($res){
                header('location: pkg_photo_video_overview.php');
            }else{
                echo "Tambah data gagal";
            }
        }
    }

    function deletePPV($id) {
        echo "nh";
        $sql = "DELETE FROM pkg_photo_video where id_pkg_photo_video = '$id'";
        $link = getLinkDatabase();
        $res = mysqli_query($link,$sql);
        if($res){
            header('location:pkg_photo_video_overview.php');
        }else{
            echo "Tambah data gagal";
        }
    }
?>