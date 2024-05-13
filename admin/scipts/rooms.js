let add_room_form = document.getElementById('add_room_form');
add_room_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_rooms();
});

function add_rooms(){
    let data= new FormData();
    data.append('add_room','');
    data.append('name',add_room_form.elements['name'].value);
    data.append('area',add_room_form.elements['area'].value);
    data.append('price',add_room_form.elements['price'].value);
    data.append('room_type',add_room_form.elements['roomt'].value);
    data.append('hostel_type',add_room_form.elements['ht'].value);
    data.append('address',add_room_form.elements['addr'].value);
    data.append('person_name',add_room_form.elements['person'].value);
    data.append('contact',add_room_form.elements['contact'].value);
    data.append('desc',add_room_form.elements['desc'].value);

    let features=[];
    let facilities=[];

    add_room_form.elements['features'].forEach(el=>{
        if(el.checked){
            features.push(el.value);
        }
    });
    add_room_form.elements['facilities'].forEach(el=>{
        if(el.checked){
            facilities.push(el.value);
        }
    });

    data.append('features',JSON.stringify(features));
    data.append('facilities',JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('add-rooms');
        var modal= bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText==1){
            add_room_form.reset();
            get_all_rooms();
            alert('success','New Room added!');
            // get_features();
        }
        else{
            alert('error','Server Down!');
        }
    }
    xhr.send(data);
}

function get_all_rooms(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload = function(){
        document.getElementById('room-data').innerHTML= this.responseText;
    }
    xhr.send('get_all_rooms');
}
let edit_room_form = document.getElementById('edit_room_form');

function edit_details(id){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        let data = JSON.parse(this.responseText);
        edit_room_form.elements['name'].value = data.roomdata.name;
        edit_room_form.elements['area'].value = data.roomdata.area;
        edit_room_form.elements['price'].value = data.roomdata.price;
        edit_room_form.elements['roomt'].value = data.roomdata.RoomType;
        edit_room_form.elements['ht'].value = data.roomdata.HostelType;
        edit_room_form.elements['addr'].value = data.roomdata.Address;
        edit_room_form.elements['description'].value = data.roomdata.desciption;
        edit_room_form.elements['person'].value = data.roomdata.personName;
        edit_room_form.elements['contact'].value = data.roomdata.contact;
        edit_room_form.elements['room_id'].value = data.roomdata.id;


        edit_room_form.elements['features'].forEach(el=>{
            if(data.features.includes(Number(el.value))){
                el.checked = true;
            }
        });

        edit_room_form.elements['facilities'].forEach(el=>{
            if(data.facilities.includes(Number(el.value))){
                el.checked = true;
            }
        });
    }
    xhr.send('get_room='+id);
}


edit_room_form.addEventListener('submit',function(e){
    e.preventDefault();
    submit_edit_rooms();
});

function submit_edit_rooms(){
    let data= new FormData();
    data.append('edit_room','');
    data.append('room_id',edit_room_form.elements['room_id'].value);
    data.append('name',edit_room_form.elements['name'].value);
    data.append('area',edit_room_form.elements['area'].value);
    data.append('price',edit_room_form.elements['price'].value);
    data.append('room_type',edit_room_form.elements['roomt'].value);
    data.append('hostel_type',edit_room_form.elements['ht'].value);
    data.append('address',edit_room_form.elements['addr'].value);
    data.append('person_name',edit_room_form.elements['person'].value);
    data.append('contact',edit_room_form.elements['contact'].value);
    data.append('description',edit_room_form.elements['description'].value);
    

    let features=[];
    let facilities=[];

    edit_room_form.elements['features'].forEach(el=>{
        if(el.checked){
            features.push(el.value);
        }
    });
    edit_room_form.elements['facilities'].forEach(el=>{
        if(el.checked){
            facilities.push(el.value);
        }
    });

    data.append('features',JSON.stringify(features));
    data.append('facilities',JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('edit-rooms');
        var modal= bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText==1){
            
            edit_room_form.reset();
            get_all_rooms();
            alert('success','Room Data edited!');
            
        }
        else{
            alert('error','Server Down!');
        }
    }
    xhr.send(data);
}

function togglestatus(id,val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(this.responseText==1){
            get_all_rooms();
            alert("success",'status toggled');
            
        }
        else{
            alert("error","server down!");
        }
    }
    xhr.send('togglestatus='+id+'&value='+val);
}

let add_image_form= document.getElementById("add_image_form");

add_image_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_image();

});

function add_image(){
    let data= new FormData();
    data.append('image',add_image_form.elements['image'].files[0]);
    data.append('room_id',add_image_form.elements['room_id'].value);
    data.append('add_image','');

    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);

    xhr.onload= function(){
        if(this.responseText == 'inv_img'){
            alert('error','Only JPG , PNG OR JPEG images allowed!','image-alert');
        }
        else if(this.responseText == 'inv_size'){
            
            alert('error','image should be less than 1mb','image-alert');
        }
        else if(this.responseText == 'upd_failed'){
            
            alert('error','Image Upload failed server down!','image-alert');
        }
        else{
            room_images(add_image_form.elements['room_id'].value,document.querySelector("#room-images .modal-title").innerText);
            add_image_form.reset();
            alert('success','New Image added','image-alert');
            
            
        }
    }
    xhr.send(data);
}

function room_images(id,rname){
    document.querySelector("#room-images .modal-title").innerText = rname;
    add_image_form.elements['room_id'].value=id;
    add_image_form.elements['image'].value="";

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload = function(){
       document.getElementById("room-image-data").innerHTML = this.responseText;

    }
    xhr.send('get_room_images='+id);

}

function rem_image(image_id,room_id)
{
    let data= new FormData();
    data.append('image_id',image_id);
    data.append('room_id',room_id);
    data.append('rem_image','');

    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);

    xhr.onload= function(){
        if(this.responseText == 1){
            room_images(room_id,document.querySelector("#room-images .modal-title").innerText);
            alert('success','image removed sucessfully','image-alert');
            
        }
        else{
            
            alert('error','Image removal failed','image-alert');
        }
    }
    xhr.send(data);
}

function thumb_image(image_id,room_id)
{
    let data= new FormData();
    data.append('image_id',image_id);
    data.append('room_id',room_id);
    data.append('thumb_image','');

    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/rooms.php",true);

    xhr.onload= function(){
        if(this.responseText == 1){
            room_images(room_id,document.querySelector("#room-images .modal-title").innerText);
            alert('success','image thumbnail changed','image-alert');
            
        }
        else{
            
            alert('error','thumbnail update failed','image-alert');
        }
    }
    xhr.send(data);
}
function remove_room(room_id)
{
    if(confirm("Are you sure, you want to delete this room?")){
        let data= new FormData();
        data.append('room_id',room_id);
        data.append('remove_room','');

        let xhr= new XMLHttpRequest();
        xhr.open("POST","ajax/rooms.php",true);

        xhr.onload= function(){
            if(this.responseText == 1){
                get_all_rooms();
                alert('success','ROOM REMOVED');
                
            }
            else{
                
                alert('error','room removal failed');
            }
        }
        xhr.send(data);
    }
   

    
}




window.onload = function(){

    get_all_rooms();
}