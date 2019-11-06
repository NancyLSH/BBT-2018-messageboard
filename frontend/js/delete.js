function deletemessage(id){
    //alert("Hello World!");
     var mesg = document.getElementById("errmessage");
    let formdata = new FormData()
    formdata.append('id',id)
    fetch('delete.php',{
        method:"POST",
        body:formdata,
    })
    .then( response => {
        return response.json()
    })
    .then( respone =>{
       
        let res = respone
        if(res.errcode != 0){
            mesg.style.display="block";
            mesg.innerText = res.errmsg
        }else{
            mesg.style.display="block";
            mesg.innerText = res.errmsg
            window.location.reload()
        }
    })
}

