<?php
	include("../conn.php"); 
	adminlogincheckonly();

	if(!empty($_GET['id'])) { 
		mysql_query("delete from bk_staff where s_id=" .$_GET['id']);
		echo "<script>alert('已删除。'); document.location.href='index.php';</script>";
	}
?>
	