<?php

    define("SITE_URL","http://127.0.0.1/homestellite/");
    define("ROOMS_IMAGE_PATH",SITE_URL."images/rooms/");
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/homestellite/images/');

    define("ROOMS_FOLDER","rooms/");


    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin'])&& $_SESSION['adminLogin']==true))
        {
            echo"
        <script>window.location.href='index.php';</script>";
        }
        session_regenerate_id(true);
    }



    function redirect($url){
        echo"
        <script>window.location.href='$url';</script>";
    }


    function alert($type,$msg){

        $bs_class = ($type=="success") ? "alert-success" : "alert-danger";
        
        echo <<<alert
                    <div class="alert $bs_class alert-dismissible fade show custom-alert" style=" position:fixed; top:80px; right:25px;" role="alert">
                       <strong class="me-3">$msg</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        alert;

    }

    function uploadImage($image,$folder){
        $valid_ex= ['image/jpeg','image/png','image/jpg'];
        $img_ex = $image['type'];

        if(!in_array($img_ex,$valid_ex)){
            return 'inv_img';
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size';
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname= 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }


    function deleteImage($image,$folder)
    {
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }
?>