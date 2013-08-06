<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
		//1连接数据库
		require "test.conf.php";

		//2 选库
		mysql_select_db("fucktest") or die("select db error!");


		

		//3 execute sql
		$sql="select id,name,age,about_she,pic from girlfriends";

		$result=mysql_query($sql);

		var_dump($result);

		//4返回结果
		//mysql_fetch_row($result);
		//mysql_fetch_assoc($result);


		echo '<div style="align:center; width:1230px;border=1px; background:#c60; color:#fff; margin:0 auto; padding:10px; overflow:hidden;">';
		echo '<h1>Mysql数据库</h1>';

		while(list($id,$name,$age,$about_she,$pic)=mysql_fetch_row($result)){
			echo '<div style="background:blue;width:400px;margin:5px; overflow:hidden; float:left; ">';
			echo '<div style="margin:10px auto; font-size:40px; height:60px; text-align:center;">'.$id.'--'.$name.'</div>';
			echo '<div style=" margin:5px 5px;">'.'年龄： '.$age.'岁'.'</div>';
			echo '<div style=" margin:5px 5px;height:40px;">'.'关于她：'.$about_she.'</div>';
			echo '<div style=" width:400px;height:600px;background:url('.$pic.') no-repeat center;text-align:center; margin:50px auto;">'.'</div>';
			echo '</div>';

		}

		echo '</div>';



?>


<?php


		echo '<div style="background:#6c0;width:100%;overflow:hidden;">' ;

			$sql="select who,time,how,pic,pid from fuck";

			$result=mysql_query($sql);

			


			while(list($who,$time,$how,$pic,$pid)=mysql_fetch_row($result)){
			echo '<div style="background:pink;width:200px;margin:5px; overflow:hidden; float:left; ">';
			echo '<div style="padding:10px 20px; font-size:40px;">'.$who.'</div>';
			echo '<div style="padding:10px 20px;">'.'做爱时间：'.$time.'分钟'.'</div>';
			echo '<div style="padding:10px 20px;">'.'在'.$how.'操了她。'.'</div>';
			echo '<div style="width:100%; text-align:center;">'.'<img src="pic/mysql'.$pid.'.jpg" width=200></div>';
			echo '</div>';

			}
			echo '<div style="background:pink; height:500px;width:400px;margin:5px; overflow:hidden; float:left; ">';
			var_dump($result);
			echo '</div>';
		echo '</div>';

?>

<?php 


			$sql="insert into fuck(who, time, how, pid) values('{$_GET["who"]}','{$_GET["time"]}','{$_GET["how"]}','{$_GET["pid"]}')";
			$result=mysql_query($sql);
			var_dump($result);
			
		mysql_close();

?>


</html>









