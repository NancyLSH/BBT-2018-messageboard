<?php
header('Content-Type: application/json');
$conn=mysqli_connect(
    'localhost',
    'root',
    '',
    'mb'
);
if(!$conn){
    printf("Can't connect to MySQL Server.Errorcode:%S",
    mysqli_connect_error());
    exit;
}else{
   //echo'数据库已连接'."<br/>";
}
mysqli_query($conn,"set character set 'utf8'");
$username=$_POST['username'];
$password=$_POST['password'];
$checkpwd=$_POST['checkpwd'];
$username=htmlspecialchars($username);
$password=htmlspecialchars($password);
$checkpwd=htmlspecialchars($checkpwd);
$selname="SELECT username FROM userinfo WHERE username='".$username."'";
$result=mysqli_query($conn,$selname);
$result= mysqli_fetch_all($result);
$selnamecount=count($result);

if($selnamecount>0){
    $result=[
    "errcode"=>1,
    "errmsg"=>"此用户已存在，请直接登录",
    "data"=>'',
];
}elseif($password==$checkpwd){
    $insert="INSERT INTO `userinfo`(`username`, `password`) VALUES (?,?)";
    $stmt=$conn->prepare($insert);
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    $result=[
        "errcode"=>0,
        "errmsg"=>"注册成功",
        "data"=>''
    ];
}else{
    $result=[
        "errcode"=>2,
        "errmsg"=>"两次输入密码不一致",
        "data"=>''
    ];
    };

echo json_encode($result);

