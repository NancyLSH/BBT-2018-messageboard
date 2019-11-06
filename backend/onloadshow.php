<?php

mysqli_query($conn,"set character set 'utf8'");    
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['password'];
global $userid;
$userid=$_SESSION['userid'];             //获取登录时的用户名，密码与id

//M(模型)————【最新留言】分页的模型建立
//取出留言de函数（留言板进阶任务一完成！）
$pageNum = 1;
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
$array_message = page_select(2);

//取出自己的留言
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
$my_array_message = page_select_myself(2);

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
$endPage = allpage_Num();

$result=[
        "errcode" =>0,
        "errmsg" =>"成功加载",
        "my_message" =>$my_array_message,     //自己的留言
        "message" => $array_message,        //最新留言
        "p" => $pageNum,                     //当前页码
    ];
    echo json_encode($result);