<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Issue Group</title>
	</head>

	<body>
		<?php 
			include("conn.php");
		
			//个人由代号转名称
			function codeToNameSingle($code) {
				$sql = "select s_name from bk_staff where s_id=".$code;
				$rs = mysql_query($sql);
				$row = mysql_fetch_array($rs);
				return $row['s_name'];
			}
		?>
		
		<table id="stuff" border="1">
			<!--<caption><span>人员管理</span> <a href="add.php">添加用户</a></caption>-->
			<tr id="stuffitem">
				<th>序号</th>
				<th>选题组名称</th>
				<th>选题组代码</th>
				<th>成员</th>
				<th>管理员</th>
				<th>用户</th>
				<th>挂起</th>
			</tr>
			<?php
				//所有成员由代号转名称
				function codeToNameGroup($member) {
					$memberArr = explode(",", $member);
					$memberStr = "";
					foreach($memberArr as $m) $memberStr .= codeToNameSingle($m).",";
					$memberStr = trim($memberStr, ",");
					return $memberStr;
				}

				$n = 1;
				$sql = "select * from bk_issuegplist";
				$rs = mysql_query($sql);
				while($row = mysql_fetch_array($rs))  {
					/*
					$memberArr = explode(",", $row['member']);
					$memberStr = "";
					foreach($memberArr as $m) $memberStr .= codeToNamesingle($m).",";
					$memberStr = trim($memberStr, ",");
					*/

					
					$member = !empty($row['member']) ? codeToNameGroup($row['member']) : "";
					$admin = !empty($row['admin']) ? codeToNameGroup($row['admin']) : "";
					$user = !empty($row['user']) ? codeToNameGroup($row['user']) : "";

					echo "<tr>";
					echo "<td>".$n."</td>";
					echo "<td><a href='gprightallocate.php?id=".$row['id']."'>".$row['listname']."</a></td>";
					echo "<td>".$row['listcode']."</td>";
					//echo "<td>".$row['member']."</td>";
					echo "<td>".$member."</td>";
					echo "<td>".$admin."</td>";
					echo "<td>".$user."</td>";
					
					if(!empty($row['member'])) {
						echo "<td><a href='process.php?sid=".$row['id']."'>清空成员</a></td>";
					} else {
						echo "<td>已挂起</td>";
					}
					?>
					<!--
					<td><a href="edit.php?id=<?php echo $rs['s_id']; ?>">编辑</a> <a href="#<?php echo $n;?>" onclick="if(confirm('<?php echo $brief1;?>')) {document.location.href='reset.php?id=<?php echo $rs['s_id']; ?>'}; return false;">重置密码</a> <a href="#<?php echo $n;?>" onclick="if(confirm('<?php echo $brief2;?>')) {document.location.href='delete.php?id=<?php echo $rs['s_id']; ?>'}; return false;">删除</a></td>
					</tr>
					-->
					<?php
					$n++;
				}
			?>
		</table>

		<a href="createissuegroup.php">创建选题组</a> <a href="index.php">返回首页</a>
		
	</body>
</html>
