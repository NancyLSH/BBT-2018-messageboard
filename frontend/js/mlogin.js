/*function p1() {
    document.getElementById("p1").style.display="none";
    document.getElementById("login").style.display="block";
    document.getElementById("nosignup").style.display="block";
}


document.getElementById("login1").addEventListener("submit",function(evt) {        
    evt.preventDefault();
    var msg = document.getElementById("result-msg");
    let username = document.getElementById("input-box-username").value;
    let password = document.getElementById("input-box-password").value;
    let formdata = new FormData()
    formdata.append('username',username)
    formdata.append('password',password)
    fetch('mlogin.php',{
        method:'POST',
        credentials:'include',
        body:formdata
    })
    .then(response =>{
        return response.json()
    })
    .then( response => {
        let res = response
        if(res.errcode != 0){
            console.log(res.errmsg) 
            msg.style.display="block"
            msg.innerText = res.errmsg
        } else{
            msg.style.display="block"
            msg.innerText= ('登录成功！')
            window.location.href = "http://localhost/homework/message%20board/messageboard.html";
        }
    })
    .catch((error) =>{
        msg.style.display="block"
        msg.innerText= error
    })

})

*/


