<?php
require_once 'common.php';
//查询
function findnewsclass(){
    $sql="select * from tbl_newsclass";
    $link=get_connect();
    $result=execQuery($sql,$link);
    return $result;
}
function finduser(){
    $sql="select * from tbl_user";
    $link=get_connect();
    $result=execQuery($sql,$link);
    return $result;
}
function findNewsClassByID($classid){
    $sql="select * from tbl_newsclass where classid=$classid";
    $link=get_connect();
    $result=execQuery($sql,$link);
    if(count($result)>0){
        return $result[0];
    }else{
        return $result;
    }
}

//编辑
function addNewsClass($classname,$classdesc){
    $link=get_connect();
    $classname=mysql_dataCheck($classname,$link);
    $classdesc=mysql_dataCheck($classdesc,$link);
    $sql="insert into tbl_newsclass(classname,classdesc) value('$classname','$classdesc')";
    $result=execUpdate($sql,$link);
    return $result;
}
function deleteNewClass($classid){
    $link=get_connect();
    $classid=mysql_dataCheck($classid,$link);
    $sql="delete from tbl_newsclass where classid=$classid";
    $result=execUpdate($sql,$link);
    return $result;
}
function editNewsClass($classid,$classname,$classdesc){
    $link=get_connect();
    $classid=mysql_dataCheck($classid,$link);
    $classname=mysql_dataCheck($classname,$link);
    $classdesc=mysql_dataCheck($classdesc,$link);
    $sql="update tbl_newsclass set classname='$classname', classdesc='$classdesc' where classid=$classid";
    $result=execUpdate($sql,$link);
    return $result;
}

?>