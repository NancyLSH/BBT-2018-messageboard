<?php

mysqli_query($conn,"set character set 'utf8'");
$username=$_POST['username'];
$password=$_POST['password'];
$username= htmlspecialchars($username);
$password=htmlspecialchars($password);
$select="SELECT `username`, `password`,`userid` FROM `userinfo` WHERE username='".$username."'";
$result=mysqli_query($conn,$select);
$result=mysqli_fetch_all($result);
$resname = @$result[0][0];   //找出原来的用户名
$h=@$result[0][1];    //找出原来的密码
//$ids = array(); 
//$ids = array_column($result, '0'); 
//var_dump($ids);


if(empty($result)){
    $result=[
        "errcode"=>1,
        "errmsg"=>"用户不存在，请先注册",
        "data"=>''
    ];
}elseif($resname==$username && $h==$password){
    $selectidres=@$result[0][2];      //找出用户的id
    session_start();
    $_SESSION['userid']=$selectidres;
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    $result=[
        "errcode"=>0,
        "errmsg"=>"登录成功",
        "data"=>''
    ];
}elseif(empty($password)){
    $result=[
        "errcode"=>2,
        "errmsg"=>"请输入密码",
        "data"=>''
    ];
}else{
    $result=[
        "errcode" =>3,
        "errmsg" =>"用户名或密码错误",
        "data" =>''
    ];
}

echo json_encode($result);