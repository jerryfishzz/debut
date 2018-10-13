<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>管理页面 - 编辑</title>
		<meta name="viewport" content="width=460">
		<meta name="MobileOptimized" content="460" /> 
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="apple-touch-fullscreen" content="yes" />
		<meta content="telephone=no" name="format-detection" />
		<meta content="email=no" name="format-detection" />
		<meta name="Description" content="">
		<link rel="stylesheet" href="../styles/ui.css" media="all" />
		<script src="../scripts/jquery.js"></script>
		<script src="../scripts/function2.js"></script>
		<!--[if lt IE9]> 
			<script src="../scripts/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php
			echo "<header>";
			echo "<h1>音乐中心后台管理</h1>";
			echo "<div id='loginfo'>";
			include("../conn.php"); 
			adminlogincheck();
			echo "</div>";
			echo "</header>";

			if(isset($_POST['name']) && isset($_POST['right']) && isset($_POST['dep'])) {
				
				$status=true;
				$right=$_POST['right'];
				$name=$_POST['name'];
				$dep=$_POST['dep'];
				
				if(preg_match('/^\s*$/', $name)) {
					$status=false;
					echo "<script>alert('姓名不能为空。'); history.back();</script>"; 
					exit();
				}

				if(preg_match('/\s/', $name)) {
					$status=false;
					echo "<script>alert('姓名中不能有空格。'); history.back();</script>";
					exit();
				}
				
				switch ($right) {
					case 1:
						$s_rtitle="管理员";
						break;
					case 2:
						$s_rtitle="用户";
						break;
					case 3:
						$s_rtitle="停用";
						break;
					default:
						$status=false;
						echo "<script>alert('需要为用户选择一个角色。'); history.back();</script>";
						exit();
				}
				
				switch ($dep) {
					case 1:
						$depname="融媒体部";
						$depcode = "rmt";
						break;
					case 2:
						$depname="办公室";
						$depcode = "bgs";
						break;
					case 3:
						$depname="资讯采编部";
						$depcode = "zx";
						break;
					case 4:
						$depname="策划部";
						$depcode = "ch";
						break;
					case 5:
						$depname="音乐节目部";
						$depcode = "yyjmb";
						break;
					case 6:
						$depname="都市节目部";
						$depcode = "ds";
						break;
					case 7:
						$depname="音乐中心";
						$depcode = "yyzx";
						break;
					case 8:
						$depname="系统";
						$depcode = "xt";
						break;
					default:
						$status=false;
						echo "<script>alert('需要为用户选择一个部门。'); history.back();</script>";
						exit();
				}
				
				if($status==true) {
					$sql2="update bk_staff set s_name='$name', s_right='$right', s_rtitle='$s_rtitle', s_dep='$dep', s_depcode='$depcode', s_depname='$depname' where s_id=" . $_GET['id'];
					mysql_query($sql2);
					echo "<script>alert('修改成功。');</script>";
				}
			}

			if(!empty($_GET['id'])) { 
				$sql = "select * from bk_staff where s_id=" .$_GET['id'] ;
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result); 
				?>
				<div class="nav1"></div>
				<div id="main">
					<div id="subform">
						<form action="" method="post" id="admineditpost">
							<span class="subformtitle">用户名　<?php echo $row['s_username']; ?></span>
							<br><br>
							<span class="subformitem">姓名：</span>
							<input type="text" name="name" class="inputstyle" id="name" value="<?php echo $row['s_name']; ?>">　<span id="pName"></span>
							<br>
							<span class="subformitem">权限：</span>
							<select name="right" id="userright">
								<option value="1" <?php echo $selected=($row['s_right']==1)? "selected": ""; ?>>管理员</option>
								<option value="2" <?php echo $selected=($row['s_right']==2)? "selected": ""; ?>>用户</option>
								<option value="3" <?php echo $selected=($row['s_right']==3)? "selected": ""; ?>>停用</option>
							</select>　<span id="pUserright"></span>
							<br>
							<span class="subformitem">部门：</span>
							<select name="dep" id="dep">
								<?php
								$sql3 = "SELECT `depid`, `depname`
									FROM `bk_departments`
									ORDER BY `depname`";
								$query3 = mysql_query($sql3);
								while ($result3 = mysql_fetch_array($query3)) {
									?>
									<option value="<?php echo $result3['depif']; ?>" <?php echo $selected=($row['s_dep'] ==
									 $result3['depid'])? "selected": ""; ?>><?php echo $result3['depname']; ?></option>
									<?php
								};
								?>
							</select>　<span id="pDep"></span>
							<br><br>
							<input type="submit" name="sub" id="sub" value="提交">　<a href='index.php'>返回首页</a>　<span id="pSuccess"></span>
						</form>
					</div>
				</div>
				<?php
			}
		?>
	</body>
</html>

