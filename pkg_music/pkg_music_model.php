<?php
    require_once("../database.php");

    function getLinkDatabase() {
        return koneksi_db();  
    }

    if (isset($_POST['addDataSubmit'])) {
        addPkgMusic();
    }

    if (isset($_GET['id_pkg_music'])) {
        $id_pkg_music = $_GET['id_pkg_music'];
        if (isset($_GET['method'])) {
            if (($_GET['method']) == "edit") {
                updatePkgMusic($id_pkg_music);
            } elseif (($_GET['method']) == "delete") {
                deletePkgMusic($id_pkg_music);
            }
        }
    }

    function selectAllpkgMusic() {
        $link = getLinkDatabase();
        $sql = "SELECT * FROM pkg_music";
        $res = mysqli_query($link,$sql);
        return $res;
    }

    function addPkgMusic() {
        $link = getLinkDatabase();

        $package_name   = $_POST['package_name'];
        $qty_vocal      = $_POST['qty_vocal'];
        $qty_piano      = $_POST['qty_piano'];
        $qty_saxophone  = $_POST['qty_saxophone'];
        $qty_biola      = $_POST['qty_biola'];
        $qty_bass       = $_POST['qty_bass'];
        $sound_system   = $_POST['sound_system'].' Watt';

        if ($sound_system == 0) {
            $sound_system = "Tidak Ada";
        }
        $sql = "INSERT INTO pkg_music values (null, '$package_name','$qty_vocal','$qty_piano','$qty_saxophone','$qty_biola','$qty_bass','$sound_system')";
        $res = mysqli_query($link,$sql);

        if($res){
            header('location: pkg_music_overview.php');
        }else{
            echo "Tambah data gagal";
        }
    }

    function updatePkgMusic($id_package) {
        $data = array();
        $data_update = array();
        $link = getLinkDatabase();

        $sql = "SELECT * FROM pkg_music WHERE id_pkg_music='$id_package'";
        $res = mysqli_query($link,$sql);

        if (mysqli_num_rows($res) > 0) {
            // output data of each row  
            while($row = mysqli_fetch_assoc($res)) {
                $data = array (
                    "id_pkg_music"  => $row['id_pkg_music'],
                    "package_name"  => $row['package_name'],
                    "qty_vocal"     => $row['qty_vocal'],
                    "qty_piano"     => $row['qty_piano'],
                    "qty_saxophone" => $row['qty_saxophone'],
                    "qty_biola"     => $row['qty_biola'],
                    "qty_bass"      => $row['qty_bass'],
                    "sound_system"  => $row['sound_system']
                );
            }
        }

        include("pkg_music_update.php");
        if (isset($_POST['updateDataSubmit'])) {
            echo "h";
            $data_update = array (
                "id_pkg_music"  => $data['id_pkg_music'],
                "package_name"  => $_POST['package_name'],
                "qty_vocal"     => $_POST['qty_vocal'],
                "qty_piano"     => $_POST['qty_piano'],
                "qty_saxophone" => $_POST['qty_saxophone'],
                "qty_biola"     => $_POST['qty_biola'],
                "qty_bass"      => $_POST['qty_bass'],
                "sound_system"  => $_POST ['sound_system']
            );
        
        
        $sql = "UPDATE pkg_music
                SET
                package_name  = '$data_update[package_name]',
                qty_vocal     = '$data_update[qty_vocal]',
                qty_piano     = '$data_update[qty_piano]',
                qty_saxophone = '$data_update[qty_saxophone]',
                qty_biola     = '$data_update[qty_biola]',
                qty_bass      = '$data_update[qty_bass]',
                sound_system  = '$data_update[sound_system]'
                WHERE pkg_music.id_pkg_music = $id_package";

            $res = mysqli_query($link,$sql);

            if($res){
                header('location: pkg_music_overview.php');
            }else{
                echo "Tambah data gagal";
            }
        }
    }

    function deletePkgMusic($id) {
        $sql = "DELETE FROM pkg_music where id_pkg_music = '$id'";
        $link = getLinkDatabase();
        $res = mysqli_query($link,$sql);
        if($res){
            header('location:pkg_music_overview.php');
        }else{
            echo "Tambah data gagal";
        }
    }
?>