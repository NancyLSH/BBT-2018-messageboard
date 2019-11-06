function back(){window.history.back(-1);}

function changeindex(){
    document.getElementById("inputmessage").style.zIndex="3";
}

function li2() {
    document.getElementById("changemsg").style.display="none";
    document.getElementById("latest-wrapper").style.display="none";
    document.getElementById("li1").style.backgroundColor="rgba(221, 221, 221, 0.466)";
    document.getElementById("li1").style.color="rgba(0, 0, 0, 0.733)";
    document.getElementById("li3").style.backgroundColor="rgba(221, 221, 221, 0.466)";
    document.getElementById("li3").style.color="rgba(0, 0, 0, 0.733)";
    document.getElementById("li2").style.backgroundColor="#555";
    document.getElementById("li2").style.color="white";
    document.getElementById('leave-message').style.display="none";
    document.getElementById('show-wrapper').style.display="block";
    document.getElementById("errmessage").style.visibility="hidden";
 }
 function li1(){
    document.getElementById("changemsg").style.display="none";
    document.getElementById("latest-wrapper").style.display="block";
     document.getElementById("li2").style.backgroundColor="rgba(221, 221, 221, 0.466)";
     document.getElementById("li2").style.color="rgba(0, 0, 0, 0.733)";
     document.getElementById("li3").style.backgroundColor="rgba(221, 221, 221, 0.466)";
     document.getElementById("li3").style.color="rgba(0, 0, 0, 0.733)";
     document.getElementById("li1").style.backgroundColor="#555";
     document.getElementById("li1").style.color="white";
     document.getElementById('leave-message').style.display="none";
     document.getElementById('show-wrapper').style.display="none";
     document.getElementById("errmessage").style.visibility="hidden";
 }
 function li3(){
    document.getElementById("changemsg").style.display="none";
    document.getElementById("latest-wrapper").style.display="none";
     document.getElementById("li2").style.backgroundColor="rgba(221, 221, 221, 0.466)";
     document.getElementById("li2").style.color="rgba(0, 0, 0, 0.733)";
     document.getElementById("li1").style.backgroundColor="rgba(221, 221, 221, 0.466)";
     document.getElementById("li1").style.color="rgba(0, 0, 0, 0.733)";
     document.getElementById("li3").style.backgroundColor="#555";
     document.getElementById("li3").style.color="white";
     document.getElementById('leave-message').style.display="block";
     document.getElementById('show-wrapper').style.display="none";
     document.getElementById("errmessage").style.visibility="hidden";
 }
function newline(){
    var wordlength = document.getElementById("inputmessage").value;
    if(wordlength != null && wordlength.length > 0){
        var len = Number(wordlength.length);
        if(len%45 == 0) {
            document.getElementById('inputmessage').value = document.getElementById('inputmessage').value + "\n";
        }}
}

document.getElementById("leave-message").addEventListener("submit",function(evt) {         //?2
    evt.preventDefault()
    console.log("祝君头发十年不少！")
    var errmsg = document.getElementById("errmessage");
    let message = document.getElementById("inputmessage").value;
    let formdata = new FormData()
    formdata.append('message',message)
    fetch('messageboard.php',{
        method:'POST',
        body:formdata,
        credentials:'include',
})
.then( response => {
    return response.json()
})
.then( response =>{
    
    let res = response
    if(res.errcode != 0){
             errmsg.style.visibility="visible";
             errmsg.innerHTML = res.errmsg
    }else{
        errmsg.style.visibility="visible";
        errmsg.innerHTML = res.errmsg;
        for(i=0;i<4;i++){
            document.getElementById('latest-wrapper_' + (i)).style.backgroundSize="100%";
            document.getElementById('latest-wrapper_' + (i)).innerHTML=('<p>' + res.message[i]['time'] + '</p>' + '<p>' + res.message[i]['message'] + '</p>');
        }
        for(i=0;i<res.my_num;i++){                 //TypeError: Cannot read property 'time' of undefined
            document.getElementById('show-wrapper_' + (i)).style.backgroundSize="100%";
            document.getElementById('show-wrapper_' + (i)).innerHTML=('<p>' + res.my_message[i]['time'] + '</p>' + '<p>' + res.my_message[i]['message'] + '</p>');
    }
}
})
.catch((error) =>{
    errmsg.style.visibility="visible"
    errmsg.innerHTML= error.toString()   
})
})


