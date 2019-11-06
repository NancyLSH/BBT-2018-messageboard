<?php

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
