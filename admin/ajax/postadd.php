<?php 
    require('../inc/db_config.php');
    require('../inc/essential.php');
    adminLogin();


    if(isset($_POST['add_room'])){
        $features= filteration(json_decode($_POST['features']));
        $facilities= filteration(json_decode($_POST['facilities']));

        $frm_data = filteration($_POST);
        $flag=0;

        $q="INSERT INTO `rooms`(`ad_id`,`name`, `area`, `price`, `RoomType`, `HostelType`, `Address`, `personName`, `contact`, `desciption`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $values=[$_POST['ad_id'],$frm_data['name'],$frm_data['area'],$frm_data['price'],$frm_data['room_type'],$frm_data['hostel_type'],$frm_data['address'],$frm_data['person_name'],$frm_data['contact'],$frm_data['desc']];


        if(insert($q,$values,'ississssss')){
            $flag=1;
        }
        $room_id= mysqli_insert_id($con);

        $q2="INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
        if($stmt = mysqli_prepare($con,$q2)){
            foreach($facilities as $f){
                mysqli_stmt_bind_param($stmt,'ii',$room_id,$f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
        else{
            $flag=0;
            die('query cannot be prepared-insert');
        }

        $q3="INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
        if($stmt = mysqli_prepare($con,$q3)){
            foreach($features as $f){
                mysqli_stmt_bind_param($stmt,'ii',$room_id,$f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
        else{
            $flag=0;
            die('query cannot be prepared-insert');
        }

        if($flag){
            echo 1;

        }
        else{
            echo 0;
        }

    }

    if(isset($_POST['add_image'])){
        $frm_data=filteration($_POST);
        $img_r = uploadImage($_FILES['image'],ROOMS_FOLDER);

        //getting room id by querying ad_id
        // $room_id = select("SELECT `id` FROM `rooms` WHERE `ad_id`",$frm_data["ad_id"],'s');
        $ad_id=$frm_data['ad_id'];
        $res=mysqli_query($con,"SELECT `id` FROM `rooms` WHERE `ad_id`=$ad_id");
        $room_id=mysqli_fetch_assoc($res)['id'];

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $qi="INSERT INTO `room_images`(`room_id`,`image`) VALUES (?,?)";
            $valu= [$room_id,$img_r];
            $res= insert($qi,$valu,'is');
            echo $res;
        }
    }


    if(isset($_POST['get_room_images'])){
        $frm_data=filteration($_POST);
        //getting room id by querying ad_id
        // $room_id = Select("SELECT `id` FROM `rooms` WHERE `ad_id`=?",[$frm_data["get_room_images"]],'i');

        $ad_id=$frm_data['get_room_images'];
        $ress=mysqli_query($con,"SELECT `id` FROM `rooms` WHERE `ad_id`=$ad_id");
        $room_id=mysqli_fetch_assoc($ress)['id'];
        if(!(is_null($room_id)) ){
            echo<<< data
            <h>yes</h>
            data ;
            
        }
        // $res = select("SELECT * FROM `room_images` WHERE `room_id`=?",[$room_id],'i');
        // $result= mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`=$room_id");
        // $res = mysqli_fetch_array($result);

        $res = select("SELECT * FROM `room_images` WHERE `room_id`=?",[$room_id],'i');

        // if(!(is_null($res)) ){
        //     echo<<< data
        //     <h>yes2</h>
        //     data ;
            
        // }

        $path= ROOMS_IMAGE_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['thumb']==1){
                $thumb_btn = "<i class= 'bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
            }
            else{
                $thumb_btn ="<button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none'>
                <i class='bi bi-check-lg'></i>
               </button>";
            }
            
            echo<<<data
                <tr class='align-middle'>
                    <td><img src='$path$row[image]'class='img-fluid'></td>
                    <td>$thumb_btn</td>
                    <td>
                       <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none'>
                        <i class='bi bi-trash'></i>
                       </button>
                    </td>
                </tr>
            data;
        }
    }

    if(isset($_POST['get_room_imagesbyid'])){
        $frm_data=filteration($_POST);
        $res = select("SELECT * FROM `room_images` WHERE `room_id`=?",[$frm_data["get_room_imagesbyid"]],'i');

        $path= ROOMS_IMAGE_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['thumb']==1){
                $thumb_btn = "<i class= 'bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
            }
            else{
                $thumb_btn ="<button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none'>
                <i class='bi bi-check-lg'></i>
               </button>";
            }
            
            echo<<<data
                <tr class='align-middle'>
                    <td><img src='$path$row[image]'class='img-fluid'></td>
                    <td>$thumb_btn</td>
                    <td>
                       <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none'>
                        <i class='bi bi-trash'></i>
                       </button>
                    </td>
                </tr>
            data;
        }
    }



    if(isset($_POST['rem_image'])){
        $frm_data=filteration($_POST);

        $values=[$frm_data['image_id'],$frm_data['room_id']];

        $pre_q = "SELECT * FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
        $res = select($pre_q,$values,'ii');
        $img= mysqli_fetch_assoc($res);

        if(deleteImage($img['image'],ROOMS_FOLDER)){
            $q="DELETE FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
            $res= delete($q,$values,'ii');
            echo $res;

        }
        else{
            echo 0;
        }

    }




    if(isset($_POST['get_room_imagesft'])){
        $frm_data=filteration($_POST);
        $res = select("SELECT * FROM `room_images` WHERE `room_id`=?",[$frm_data["get_room_imagesft"]],'i');

        $path= ROOMS_IMAGE_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['thumb']==1){
                $thumb_btn = "<i class= 'bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
            }
            else{
                $thumb_btn ="<button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-secondary shadow-none'>
                <i class='bi bi-check-lg'></i>
               </button>";
            }
            
            echo<<<data
                <tr class='align-middle'>
                    <td><img src='$path$row[image]'class='img-fluid'></td>
                    <td>$thumb_btn</td>
                    <td>
                       <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn btn-danger shadow-none'>
                        <i class='bi bi-trash'></i>
                       </button>
                    </td>
                </tr>
            data;
        }
    }



    if(isset($_POST['thumb_image'])){
        $frm_data=filteration($_POST);

        $pre_q= "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=?";
        $pre_v=[0,$frm_data['room_id']];
        $pre_res = update($pre_q,$pre_v,'ii');

        $q = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=? AND `ROOM_ID`=?"; 
        $V = [1,$frm_data['image_id'],$frm_data['room_id']];
        $pre_res= update($q,$V,'iii');

        echo $pre_res;

    }
?>