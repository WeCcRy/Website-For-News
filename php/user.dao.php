<?php
    require_once 'common.php';
    function findUsers(){
        $sql="select * from tbl_user";
        $link=get_connect();
        $result=execQuery($sql,$link);
        return $result;
    }
    

    function findUserByName($username){
        $link=get_connect();
        $username=mysql_dataCheck($username,$link);
        $sql="select * from tbl_user where uname='$username'";
        $result=execQuery($sql,$link);
        if(count($result)>0){
            return $result[0];
        }else{
            return $result;
        }
    }
    // $result=findUserByName('admin');
    // var_dump( $result);

    function findUserById($userId){
        $link=get_connect();
        $username=mysql_dataCheck($userId,$link);
        $sql="select * from tbl_user where uid=$userId";
        $result=execQuery($sql,$link);
        if(count($result)>0){
            return $result[0];
        }else{
            return $result;
        }
    }

    function addUser($username,$userpwd,$email,$gender,$power){
        $link=get_connect();
        $username=mysql_dataCheck($username,$link);
        $userpwd=mysql_dataCheck($userpwd,$link);
        $email=mysql_dataCheck($email,$link);
        $gender=mysql_dataCheck($gender,$link);
        $power=mysql_dataCheck($power,$link);
        $regtime=strftime("%Y-%m-%d %H:%M:%S");

        $sql="insert into tbl_user (uname,upass,uemail,regtime,gender,power) values ('$username','$userpwd','$email','$regtime','$gender','$power')";
        $result=execUpdate($sql,$link);
        return $result;
    }

    function deleteUser($uid){
        $link=get_connect();
        $uid=mysql_dataCheck($uid,$link);
        $sql="delete from tbl_user where uid=$uid";
        $result=execUpdate($sql,$link);
        return $result;
    }
    function updateUserPass($uid,$password){
        $link=get_connect();
        $uid=mysql_dataCheck($uid,$link);
        $password=mysql_dataCheck($password,$link);
        $sql="update tbl_user set upass='$password' where uid='$uid'";
        $result=execUpdate($sql,$link);
        return $result;
    }
    function updateUser($uid,$username,$userpwd,$email,$heading,$gender){
        $link=get_connect();
        $uid=mysql_dataCheck($uid,$link);
        $username=mysql_dataCheck($username,$link);
        $userpwd=mysql_dataCheck($userpwd,$link);
        $email=mysql_dataCheck($email,$link);
        $heading=mysql_dataCheck($heading,$link);
        $gender=mysql_dataCheck($gender,$link);
        $sql="update tbl_user set uname='$username',upass='$userpwd',uemail='$email',heading='$heading',gender='$gender' where uid='$uid'";
        $result=execUpdate($sql,$link);
        return $result;
    }
?>