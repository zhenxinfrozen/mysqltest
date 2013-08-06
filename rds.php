<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
		//1连接数据库
		require "rds.conf.php";

		//2 选库
		mysql_select_db("db86w70r3yd4p04f") or die("select db error!");

		

		//3 execute sql
		$sql="select who,time ,how, pic from fuck";

		$result=mysql_query($sql);

		var_dump($result);

		//4返回结果
		//mysql_fetch_row($result);
		//mysql_fetch_assoc($result);


		echo '<div style="align:center; width:1230px;height:2660px;border=1px; background:#c60; color:#fff; margin:0 auto; text-align:center; padding:10px;">';
		echo '<h1>Mysql数据库</h1>';

		while(list($who,$time,$how,$pic)=mysql_fetch_row($result)){
			echo '<div style="background:pink; height:500px;width:400px;margin:5px; overflow:hidden; float:left; ">';
			echo '<div style="margin:50px auto; font-size:40px; height:60px;">'.$who.'</div>';
			echo '<div style="float:left; margin:50px 5px; height:60px;">'.$time.'分钟'.'</div>';
			echo '<div style="float:left; margin:50px 5px; height:60px;">'.$how.'</div>';
			echo '<div style=" text-align:center; margin:50px 5px;">'.'<img src="'.$pic.'" width=200">'.'</div>';
			echo '</div>';

		}

		echo '<div>';

		mysql_close();
?>

</html>









