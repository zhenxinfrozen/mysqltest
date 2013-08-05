<?php
		//1连接数据库
		require "conf.php";

		//2 选库
		mysql_select_db("fucktest") or die("select db error!");

		

		//3 execute sql
		$sql="select who,time ,how, pic from fuck";

		$result=mysql_query($sql);

		var_dump($result);

		//4返回结果
		//mysql_fetch_row($result);
		//mysql_fetch_assoc($result);
		mysql_data_seek($result, 0);
		while($data=mysql_fetch_assoc($result)){

		echo "<br/><br/><br/>";
		print_r($data);
		echo "<br/>";
		}


		mysql_close();
?>











