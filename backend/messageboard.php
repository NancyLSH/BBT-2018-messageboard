<?php

mysqli_query($conn,"set character set 'utf8'");
session_start();
global $userid;
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
$message=$_POST['message'];
$message=htmlspecialchars($message);
$message_count = mb_strwidth($message);                          //中文2个字节，英文1个字节的统计字符方法
//var_dump($message_count);
    
if(empty($message)){
    //echo "留言不能为空";
    $result=[
        "errcode" =>1,
        "errmsg" =>"留言不能为空",
        "data" =>''
    ];
}elseif($message_count>=50){
    //echo "留言多于50字";
    $result=[
        "errcode" =>2,
        "errmsg" =>"留言多于50字",
        "data" =>''
    ];
}else{
    //echo "留言成功";
    $inputmessage="INSERT INTO `message`(`message`, `userid`) VALUES (?,?)";
    $stmt=$conn->prepare($inputmessage);
    $stmt->bind_param("si",$message,$userid);
    $stmt->execute();
    $id=mysqli_insert_id($conn);

//查询显示出总行数
function allpage_Num(){
    $PageSize = 4;
    $page_allnum ="select count(*) num from message";
if(!$page_allnum){
    //echo "查询不成功";
}else{
    //echo "查询成功";
    $page_allnumber =mysqli_query($GLOBALS['conn'],$page_allnum);
    $obj = mysqli_fetch_object($page_allnumber);
    $allNum = $obj->num;
    $endPage = ceil($allNum/$PageSize);         //总页数
    return $endPage;
}
}
global $endPage;
$endPage = allpage_Num();

//查询显示出自己留言的总行数
function my_allpage_Num(){
    $PageSize = 4;
    $page_allnum ="select count(*) num from message inner join userinfo on message.userid = userinfo.userid and userinfo.userid = '".$GLOBALS['userid']."'";
if(!$page_allnum){
    //echo "查询不成功";
}else{
    //echo "查询成功";
    $page_allnumber =mysqli_query($GLOBALS['conn'],$page_allnum);
    $obj = mysqli_fetch_object($page_allnumber);
    $allNum = $obj->num;
    $endPage = ceil($allNum/$PageSize);         //总页数
    return $endPage;
}
}
global $my_endPage;
$my_endPage = my_allpage_Num();

//取出留言de函数（留言板进阶任务一完成！）
function page_select($pageNum){
    $PageSize = 4;
    $page_function = "SELECT*FROM `message` LIMIT ".($pageNum-1)*$PageSize .",$PageSize";     //取出留言，id，时间的mysql语句
    $page_function_result = mysqli_query($GLOBALS['conn'], $page_function);                //执行语句
if(!$page_function_result){                                                 //???如何判断sql语句是否执行成功
    //echo "取出不成功";
}else{
    //echo "取出成功";
    $array_message = [];                   //先要在循环外建一个数组
    while($row = mysqli_fetch_array($page_function_result,MYSQLI_ASSOC)){    
    $array_message[] = $row;               //进行循环后把$row都压进数组中
    } 
 return $array_message;                    //返回一个数组
};
}
$array_message = page_select($endPage);

//取出自己的留言的函数
function page_select_myself($pageNum){
    $PageSize = 4;
    $page_function = "SELECT*FROM `message` inner join userinfo on message.userid = userinfo.userid and userinfo.userid = '".$GLOBALS['userid']."' LIMIT ".($pageNum-1)*$PageSize .",$PageSize";     //取出留言，时间的mysql语句
    $page_function_result = mysqli_query($GLOBALS['conn'], $page_function);    //执行语句
if(!$page_function_result){                                                    //???如何判断sql语句是否执行成功
    //echo "取出不成功";
}else{
    //echo "取出成功";
    $my_array_message = [];                   //先要在循环外建一个数组
    while($row = mysqli_fetch_array($page_function_result,MYSQLI_ASSOC)){    
    $my_array_message[] = $row;               //进行循环后把$row都压进数组中
    } 
return $my_array_message;                    //返回一个数组
};
}
$my_array_message = page_select_myself($my_endPage);
$my_num = count($my_array_message);

    $result=[
        "errcode" =>0,
        "errmsg" =>"留言成功",
        "message" =>$array_message,          //最新的4条留言
        "my_message" =>$my_array_message,     //自己的留言
        "my_num" =>$my_num,
    ];
};

echo json_encode($result);

