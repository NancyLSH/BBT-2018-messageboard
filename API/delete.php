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
$id=$_POST['id'];
session_start();
$userid=$_SESSION['userid'];
//var_dump($userid);
//var_dump($id);
$deletemsg="DELETE FROM `message` WHERE id='".$id."'";
$delete_msg=mysqli_query($conn,$deletemsg);
//var_dump($delete_msg);
if($delete_msg){
    //echo "删除成功！";
    $result=[
        "errcode" => 0,
        "errmsg" =>"删除成功！",
        "data" =>'',
    ];
}else{
    //echo "删除失败！";
    $result=[
        "errcode" =>1,
        "errmsg" =>"删除失败！",
        "data" =>'',
    ];
};

echo json_encode($result);
