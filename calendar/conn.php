<?php
	session_start();
	mysql_connect("localhost", "root", "") or die("mysql连接失败");
	mysql_select_db("bk") or die("mysql连接失败");
	mysql_query("set names utf8");
	
	//变量$id只是为了页面跳转回相应的选题组，和登录用户没有关系。
	function logincheck() {
		if (isset($_SESSION['flag']) && isset($_COOKIE['sid'])) {
			if ($_SESSION['flag']=="logged" && !empty($_COOKIE['sid'])) {
				$sql_user="select * from bk_staff where s_id=".$_COOKIE['sid'];
				$rs_user=mysql_query($sql_user);
				$row_user=mysql_fetch_array($rs_user);

				if($row_user['s_right']==1 || $row_user['s_right']==2) {
					//查看用户是否在任意选题组中有权限或者是否为管理员
					if(!empty($row_user['s_inissues']) || $row_user['s_right']==1) {  
							echo "<h1 id='pageAdditional'><a href='profile.php?id=".$_COOKIE['sid']."'>".$_COOKIE['name']."</a> 已登录&nbsp;&nbsp;<a id='inOutBack' href='../logout.php'>退出</a></h1>";
					} else {
						header("location:oops.php");
						exit();
					}
				} else if($row_user['s_right']==4) {  //游客权限
					header("location:oops.php");
					exit();
				} else {
					echo "<script>alert('用户已被停用。请联系管理员。'); document.location.href='oops.php';</script>";
				}
			} else {
				header("location:oops.php");
				exit();
			}
		} else {
			header("location:oops.php");
			exit();
		}
	}

	//防止php处理页面在游客权限下也能操作
	function logincheckforguest() {
		if (isset($_COOKIE['sid']) && isset($_SESSION['flag'])) {
			if ($_SESSION['flag']=="logged" && !empty($_COOKIE['sid'])) {
				$sql_user="select * from bk_staff where s_id=".$_COOKIE['sid'];
				$rs_user=mysql_query($sql_user);
				$row_user=mysql_fetch_array($rs_user);
				if($row_user['s_right']==4) {
					header("location:oops.php");
					exit();
				}
			} else {
				header("location:oops.php");
				exit();
			}
		} else {
			header("location:oops.php");
			exit();
		}
	}

	function htmltocode($content)  { 
		$content=htmlspecialchars($content, ENT_QUOTES);
		return $content;
	}

	function prePrintR($print, $die=FALSE){
		echo '<pre>';
		print_r($print);
		echo '</pre><hr>';
	
		if($die) die();
	}
