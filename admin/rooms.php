<?php
     require('inc/essential.php');
     require('inc/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homestellite-Rooms</title>

    <?php require('inc/Alinks.php'); ?>

</head>
<body>

    <?php require('Aheader.php'); ?>

    <div class="container-fluid " id="main_content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Rooms</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-rooms">
                                <i class="bi bi-plus-square"></i>Add
                            </button>
                        </div>

                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thread>
                                    <tr class="bg-dark text-light">
                                        <th scope="col"># </th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Types</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thread>
                                <tbody id="room-data">
                                </tbody>

                            </table>
 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Add room model  -->

    <div class="modal fade" id="add-rooms" data-bs-backup="static" data-bs-keyboared="true" tabindex="-1" >
        <div class="modal-dialog modal-lg">
            <form action="" id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Area</label>
                            <input type="text" name="area" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">price</label>
                            <input type="text" name="price" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Room Type</label>
                            <select name="roomt" class="form-select shadow-none">
                                <option selected>Open this select menu</option>
                                <option value="1">1 seater</option>
                                <option value="2">2 seater</option>
                                <option value="3">3 seater</option>
                                <option value="4">4 seater</option>
                                <option value="5">5 seater</option>
                                <option value="5">6 seater</option>
                                <option value="5">7 seater</option>
                                <option value="5">8 seater</option>
                            </select>
                            <!-- <input type="text" name="quantity" class="form-control shadow-none" required> -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Hostel Type</label>
                            <input type="text" name="ht" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Address</label>
                            <input type="text" name="addr" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Person Name</label>
                            <input type="text" name="person" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Contact</label>
                            <input type="text" name="contact" class="form-control shadow-none" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row">
                                <?php
                                    //  $res= selectAll('features');
                                    $sql = "SELECT * FROM `features`";
                                    $result = mysqli_query($con,$sql);
                                     while($opt = mysqli_fetch_Assoc($result)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                     <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                     $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Facilities</label>
                            <div class="row">
                                <?php
                                    //  $res= selectAll('features');
                                    $sql = "SELECT * FROM `facilities`";
                                    $result = mysqli_query($con,$sql);
                                     while($opt = mysqli_fetch_Assoc($result)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                     <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                     $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- edit room modal  -->
    <div class="modal fade" id="edit-rooms" data-bs-backup="static" data-bs-keyboared="true" tabindex="-1" >
        <div class="modal-dialog modal-lg">
            <form action="" id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Area</label>
                            <input type="text" name="area" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">price</label>
                            <input type="text" name="price" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Room Type</label>
                            <select name="roomt" class="form-select shadow-none">
                                <option selected>Open this select menu</option>
                                <option value="1">1 seater</option>
                                <option value="2">2 seater</option>
                                <option value="3">3 seater</option>
                                <option value="4">4 seater</option>
                                <option value="5">5 seater</option>
                                <option value="6">6 seater</option>
                                <option value="7">7 seater</option>
                                <option value="8">8 seater</option>
                            </select>
                            <!-- <input type="text" name="quantity" class="form-control shadow-none" required> -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Hostel Type</label>
                            <input type="text" name="ht" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Address</label>
                            <input type="text" name="addr" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Person Name</label>
                            <input type="text" name="person" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label fw-bold">Contact</label>
                            <input type="text" name="contact" class="form-control shadow-none" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Features</label>
                            <div class="row">
                                <?php
                                    //  $res= selectAll('features');
                                    $sql = "SELECT * FROM `features`";
                                    $result = mysqli_query($con,$sql);
                                     while($opt = mysqli_fetch_Assoc($result)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                     <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                     $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Facilities</label>
                            <div class="row">
                                <?php
                                    //  $res= selectAll('features');
                                    $sql = "SELECT * FROM `facilities`";
                                    $result = mysqli_query($con,$sql);
                                     while($opt = mysqli_fetch_Assoc($result)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                     <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                     $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" rows="4" class="form-control shadow-none" required></textarea>
                        </div>
                        <input type="hidden" name="room_id">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- manage images room model  -->
    <!-- Modal -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Hostel Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert">

                    </div>
                <div class="border-bottom border-3 pb-3 mb-3">
                    <form action="" id="add_image_form">
                        <label class="form-label fw-bold">Add Image</label>
                        <input type="file" name="image" accept=".jpg, .png, .jpeg" class="form-control shadow-none mb-3" required>
                        <button class="btn custom-bg text-white shadow-none">ADD</button>
                        <input type="hidden" name="room_id">
                    </form>
                </div>
                <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thread>
                                    <tr class="bg-dark text-light sticky-top">
                                        <th scope="col" width="60%">Image</th>
                                        <th scope="col">Thumb</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thread>
                                <tbody id="room-image-data">
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
    

    <?php require('inc/scripts.php'); ?>
    <script src="scipts/rooms.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    
</body>
</html>
