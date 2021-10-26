<?php
function get_connect(){
    //数据库默认连接信息
    $config = array(
       'host' => '127.0.0.1',
       'user' => 'root',
       'password' => 'root',
       'charset' => 'utf8',
       'dbname' => 'db_news',
       'port' => 3306
    );
    $link = mysqli_connect($config['host'].':'.$config['port'],$config['user'],$config['password'],$config['dbname']);    
    if(!$link){
      die('数据库连接失败!') ;
    } 
    //设置字符集，选择数据库
    mysqli_query($link,'set names '.$config['charset']);   
    return $link;
 }
function  mysql_dataCheck($parameter,$link){
    return mysqli_real_escape_string($link,$parameter);
}
function execQuery($strQuery,$link){  
    $res= mysqli_query($link,$strQuery);
    if(!$res) die(mysqli_error($link));
    //定义结果数组，用以保存结果信息
    $results = array();
    //遍历结果集，获取每条记录的详细数据
     while($row = mysqli_fetch_assoc($res)){
     //把从结果集中取出的每一行数据赋值给$emp_info数组
       $results[] = $row;
    }   
    mysqli_free_result($res);//释放记录集
    mysqli_close($link);//关闭数据库连接
    return $results;
}
function execUpdate($strUpdate,$link){  
    $res=mysqli_query($link,$strUpdate);
    if(!$res) die('数据库操作失败!').mysqli_error($link);  
    mysqli_close($link);
    return $res;  
}

?>