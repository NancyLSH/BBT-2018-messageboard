function changemessage(id){
    document.getElementById("changemsg").style.display="block";

    console.log("成功连接js")
    let changemsg = document.getElementById("changemsg").value;
    var mesg = document.getElementById("errmessage");
    let formdata = new FormData()
    formdata.append('changemsg',changemsg)
    formdata.append('id',id)
    fetch('change.php',{
        method:'POST',
        body:formdata,
    })
    .then( response => {
        return response.json()
    })
    .then( response =>{
        console.log("＞﹏＜")
        let res = response
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