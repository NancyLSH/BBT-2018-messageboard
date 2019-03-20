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
$changsmsg=$_POST['changemsg'];
$changsmsg=htmlspecialchars($changsmsg);
//var_dump($changsmsg);
//var_dump($id);
//$change="UPDATE `message` SET `message`='".$changsmsg."' WHERE id='".$id."'";

                                      

if(empty($changsmsg)){
    //echo "输入内容不能为空！";
    $result=[
        "errcode" => 1,
        "errmsg" =>"<<请输入更改内容>>",
        "data" =>''
    ];
}else{
    //echo "更改成功！";
    $change="UPDATE `message` SET `message`=? WHERE id='".$id."'";
    $stmt=$conn->prepare($change);
    $stmt->bind_param("s",$changsmsg);
    $stmt->execute();   
    $result=[
        "errcode" =>0,
        "errmsg" => "更改成功！",
        "data" =>''
    ];
}

echo json_encode($result);