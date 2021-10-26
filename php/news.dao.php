<?php
    require_once 'common.php';

    function findNews(){
        $sql="select * from tbl_news order by publishtime desc";
        $link=get_connect();
        $result=execQuery($sql,$link);
        return $result;
    }
	function find3News(){
		$sql="select * from tbl_news where istop = '1' order by publishtime desc limit 3";
		$link=get_connect();
		$result=execQuery($sql,$link);
		return $result;
	}
	function find3NewsByClassID($classid){
		$sql="select * from tbl_news where classid=$classid and istop = '1' order by publishtime desc limit 3";
		$link=get_connect();
		$result=execQuery($sql,$link);
		return $result;
	}
	function find9News(){
		$sql="select * from tbl_news order by publishtime desc limit 9";
		$link=get_connect();
		$result=execQuery($sql,$link);
		return $result;
	}
	function find9NewsByClassID($classid){
		$sql="select * from tbl_news where classid=$classid order by publishtime desc limit 9";
		$link=get_connect();
		$result=execQuery($sql,$link);
		return $result;
	}
	function find9News_page($page,$pagesize){
	    $maxpage=maxpage_findNews($pagesize);
	    if($maxpage<1) return null;
	    $page=$page>$maxpage ?$maxpage :$page;
	    $offset=($page-1)*$pagesize;
	    $sql="select * from tbl_news order by publishtime desc limit $offset,$pagesize";
	    $link=get_connect();
	    $result=execQuery($sql,$link);
	    return $result;
	}
	function find9News_pageByClassID($classid,$page,$pagesize){
	    $maxpage=maxpage_findNewsByClassID($classid,$pagesize);
	    if($maxpage<1) return null;
	    $page=$page>$maxpage ?$maxpage :$page;
	    $offset=($page-1)*$pagesize;
	    $sql="select * from tbl_news where classid=$classid order by publishtime desc limit $offset,$pagesize";
	    $link=get_connect();
	    $result=execQuery($sql,$link);
	    return $result;
	}
	function findhotNews(){
		$sql="select * from tbl_news order by viewcount desc limit 20";
		$link=get_connect();
		$result=execQuery($sql,$link);
		return $result;
	}
	function find10hotNews(){
		$sql="select * from tbl_news order by viewcount desc limit 10";
		$link=get_connect();
		$result=execQuery($sql,$link);
		return $result;
	}
	function findhotNewsByClassID($classid){
		$sql="select * from tbl_news where classid=$classid order by viewcount desc limit 20";
		$link=get_connect();
		$result=execQuery($sql,$link);
		return $result;
	}
    function maxpage_findNews($pagesize){
        $sql="select count(*) as num from tbl_news";
        $link=get_connect();
        $result=execQuery($sql,$link);
        $num=$result[0]['num'];
        return ceil($num/$pagesize);
    }
    function findNews_page($page,$pagesize){
        $maxpage=maxpage_findNews($pagesize);
        if($maxpage<1) return null;
        $page=$page>$maxpage ?$maxpage :$page;
        $offset=($page-1)*$pagesize;
        $sql="select * from tbl_news order by publishtime desc limit $offset,$pagesize";
        $link=get_connect();
        $result=execQuery($sql,$link);
        return $result;
    }

    function findNewsByClassID($classid){
        $link=get_connect();
        $classid=mysql_dataCheck($classid,$link);
        $sql="select * from tbl_news where classid=$classid order by publishtime desc";
        $result=execQuery($sql,$link);
        return $result;
    }
    function maxpage_findNewsByClassID($classid,$pagesize){
        $sql="select count(*) as num from tbl_news where classid=$classid order by publishtime desc";
        $link=get_connect();
        $result=execQuery($sql,$link);
        $num=$result[0]['num'];
        return ceil($num/$pagesize);
    }
    function findNewsByClassID_page($classid,$page,$pagesize){
        $maxpage=maxpage_findNewsByClassID($classid,$pagesize);
        if($maxpage<1) return null;
        $page=$page>$maxpage ?$maxpage :$page;
        $offset=($page-1)*$pagesize;
        $sql="select * from tbl_news where classid=$classid order by publishtime desc limit $offset,$pagesize";
        $link=get_connect();
        $result=execQuery($sql,$link);
        return $result;
    }

    function findNewsByName($keyword,$search_field='all'){
        $link=get_connect();
        $keyword=mysql_dataCheck($keyword,$link);
        $search_field=mysql_dataCheck($search_field,$link);
        if($search_field ==='all'){
            $sql="select * from tbl_news where title like '%$keyword%' or content like '%$keyword%' order by publishtime desc";
        }else{
            $sql="select * from tbl_news where $search_field like '%$keyword%' order by publishtime desc";
        }
        $result=execQuery($sql,$link);
        return $result;
    }
    function maxpage_findNewsByName($keyword,$search_field,$pagesize){
        $link=get_connect();
        $keyword=mysql_dataCheck($keyword,$link);
        $search_field=mysql_dataCheck($search_field,$link);
        if($search_field ==='all'){
            $sql="select count(*) as num from tbl_news where title like '%$keyword%' or content like '%$keyword%' ";
        }else{
            $sql="select count(*) as num from tbl_news where $search_field like '%$keyword%'";
        }
        $result=execQuery($sql,$link);
        $num=$result[0]['num'];
        return ceil($num/$pagesize);
    }
    function findNewsByName_page($keyword,$search_field,$page,$pagesize){
        $maxpage=maxpage_findNewsByName($keyword,$search_field,$pagesize);
        if($maxpage<1) return null;
        $page=$page>$maxpage ?$maxpage :$page;
        $offset=($page-1)*$pagesize;
        $link=get_connect();
        $keyword=mysql_dataCheck($keyword,$link);
        $search_field=mysql_dataCheck($search_field,$link);
        if($search_field ==='all'){
            $sql="select * from tbl_news where title like '%$keyword%' or content like '%$keyword%' order by publishtime desc";
        }else{
            $sql="select * from tbl_news where $search_field like '%$keyword%' order by publishtime desc";
        }
        $result=execQuery($sql,$link);
        return $result;
    }
    function findNewsByID($newsID){
        $link=get_connect();
        $newsID=mysql_dataCheck($newsID,$link);
        $sql="select * from tbl_news where newsID=$newsID";
        $result=execQuery($sql,$link);
        if(count($result)>0){
            return $result[0];
        }else{
            return $result;
        }
        
    }
    function addNews($title,$content,$uid,$classid,$img,$stop){
        $link=get_connect();
        $title=mysql_dataCheck($title,$link);
        $content=mysql_dataCheck($content,$link);
        $uid=mysql_dataCheck($uid,$link);
        $classid=mysql_dataCheck($classid,$link);
		$img=mysql_dataCheck($img,$link);
        $publishtime=strftime("%Y-%m-%d %H:%M:%S");
        $sql="insert into tbl_news (title,content,publishtime,uid,classid,newsimg,istop) value ('$title','$content','$publishtime','$uid','$classid','$img','$stop')";
        $result=execUpdate($sql,$link);
        return $result;
    }
	function dianzan($newsid){
		$sql="update tbl_news set likecount=likecount+1 where newsid = $newsid;";
		$link=get_connect();
		$result=execUpdate($sql,$link);
		return $result;
	}
	function add($newsid){
		$sql="update tbl_news set viewcount=viewcount+1 where newsid = $newsid;";
		$link=get_connect();
		$result=execUpdate($sql,$link);
		return $result;
	}

?>