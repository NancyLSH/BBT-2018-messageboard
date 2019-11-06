<?php
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