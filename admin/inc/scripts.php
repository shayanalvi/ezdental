<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function alert(type,msg,position='body'){
        let bs_class = (type=="success") ? "alert-success" : "alert-danger";
        let element = document.createElement('div');
        element.innerHTML = `
                    <div class="alert ${bs_class} alert-dismissible fade show custom-alert" style=" position:fixed; top:80px; right:25px;" role="alert">
                       <strong class="me-3">${msg}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        `;
        if(position=='body'){
            document.body.append(element);
        }
        else{
            document.getElementById(position).appendChild(element);
        }
        
        setTimeout(remAlert,2000);
    }
    function remAlert(){
        var liElements = document.getElementsByClassName('alert');
        if (liElements.length > 0) {
            liElements[0].remove();
        }
    }
</script>