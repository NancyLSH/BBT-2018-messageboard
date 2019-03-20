function remarkdiaper(){
    document.getElementById("input1").placeholder=" ";
    
}
function remarkdiaper2(){
    document.getElementById("input2").placeholder=" ";
}

document.getElementById("signup").addEventListener("submit", function(evt) {
    console.log("啪！拔十根头发！");
    evt.preventDefault();
    var msg = document.getElementById("result-msg");
    let username = document.getElementById("input1").value;
    let password = document.getElementById("input2").value;
    let checkpwd = document.getElementById("input3").value;  
    let formdata = new FormData()
    formdata.append('username',username)
    formdata.append('password',password)
    formdata.append('checkpwd',checkpwd)
    fetch( 'msignup.php' , {
        method:'POST',
        body: formdata
    })
    .then(response =>{
        return response.json()
    })
    .then( response => {
        let res = response
        if(res.errcode !=0){
            console.log(res.errmsg)  
            msg.style.display="block"
            msg.innerText = res.errmsg
        }else{
            msg.style.display="block"
            msg.innerText= ('注册成功！')
            window.location.href = "http://localhost/homework/message%20board/mlogin.html"
        }
    })
    .catch((error) =>{
        msg.style.display="block"
        msg.innerText= error
    })

})


