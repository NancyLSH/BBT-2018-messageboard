window.onload = function() {
    console.log("debug开心吗？")

    fetch('onloadshow.php',{
        method:"GET",
    })
    .then( response => {
        return response.json()
    })
    .then( response =>{
        console.log(".....开心呜呜呜呜呜")
        let res = response
        for(i=0;i<4;i++){
            document.getElementById('latest-wrapper_' + (i)).style.backgroundSize="100%";
            document.getElementById('latest-wrapper_' + (i)).innerHTML=('<p>' + res.message[i]['time'] + '</p>' + '<p>' + res.message[i]['message'] + '</p>');
        }
        for(i=0;i<4;i++){
            document.getElementById('show-wrapper_' + (i)).style.backgroundSize="100%";
            document.getElementById('show-wrapper_' + (i)).innerHTML=('<p>' + res.my_message[i]['time'] + '</p>' + '<p>' + res.my_message[i]['message'] + '</p>');
        }
        
        })
    }

