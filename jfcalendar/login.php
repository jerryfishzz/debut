<!DOCTYPE html>
<html dir="ltr" lang="zh-CN">
	<head>
		<meta name="viewport" content="width=460">
		<meta name="MobileOptimized" content="460" /> 
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="apple-touch-fullscreen" content="yes" />
		<meta content="telephone=no" name="format-detection" />
		<meta content="email=no" name="format-detection" />
		<meta name="Description" content="">
		<link rel="stylesheet" href="styles/ui.css" media="all" />
		<!--[if lt IE9]> 
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->

		<meta charset="UTF-8">
		<title>登录</title>
		<link rel="stylesheet" type="text/css" href="css/jquery-ui/smoothness/jquery-ui-1.8.1.custom.css" />
		<link rel="stylesheet" type="text/css" href="css/ui.css" />
		
	</head>

	<body style="background-color: #aaaaaa;">

		<style type="text/css" media="screen">
			body { font-size: 62.5%; }
			.shadow {
				-moz-box-shadow: 3px 3px 4px #aaaaaa;
				-webkit-box-shadow: 3px 3px 4px #aaaaaa;
				box-shadow: 3px 3px 4px #aaaaaa;
				/* For IE 8 */
				-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#aaaaaa')";
				/* For IE 5.5 - 7 */
				filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#aaaaaa');
			}
		</style>
		
		<h1 id="pageAdditional"><a id="inOutBack" href="calendar.php">返回选题页面</a></h1>
		<h1 id="pageTitle">用户登录</h1>
			
		<div id="tabs">

			<div id="tabs-2">

				<?php
					include("conn.php");

					// 此处判断post过来有没有值，无值则页面无反应，且拒绝0。
					if (!empty($_POST["s_username"]) && !empty($_POST["s_password1"])) {	
						
						$usr = $_POST["s_username"];
						$pwd=md5($_POST["s_password1"]);	
						$status=true;
						
						// 这两行是处理用户名和密码中的html标签之类的非法字符的
						if (!filter_var($usr, FILTER_SANITIZE_STRING))  $status=false;
						if (!filter_var($pwd, FILTER_SANITIZE_STRING))  $status=false;

						if ($status==true) {
							$sql="select * from bk_staff where s_username='".$usr."' and s_password1='".$pwd."'";
							$query=mysql_query($sql);
							if($rs=mysql_fetch_array($query)) {
								if($rs['s_right']!=3) {
									$_SESSION['flag']="logged";
									setcookie("name", $rs['s_name'], time()+3600);
									setcookie("sid", $rs['s_id'], time()+3600);

									//setcookie("name", $rs['s_name'], time()+10);
									//setcookie("sid", $rs['s_id'], time()+10);

									$sql_log="update bk_staff set s_logged=s_logged+1 where s_id=".$rs['s_id'];
									if(mysql_query($sql_log)) {
										header("Location:calendar.php");
										exit();
									}
								} else {
									$status=false;
									echo "<script>alert('用户已被停用。请联系管理员。'); document.location.href='login.php';</script>";
									exit();
								}
							} else {
								$status=false;
							}
						}

						if ($status==false) {
							echo "<script>alert('请检查您的输入。'); document.location.href='login.php';</script>";
							exit();
						}
						
					}
				?>

				<form action="" method="post">
					<fieldset id="login">
						用户名　<input class="con" type="text" name="s_username"><br><br>
						　密码　<input class="con" type="password" name="s_password1"><br /><br>
						<!--<input type="hidden" name="tableCode" value="<?php echo $_GET['id'];?>">-->
						<input type="submit" value="登录" id="login_btn"> 
					</fieldset>
				</form>
			
			</div>

		</div>
	</body>
</html>