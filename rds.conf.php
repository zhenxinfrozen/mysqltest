<?php
		//step 1 connect
		$link = mysql_connect("rdsmqz7rbz67rbm.mysql.rds.aliyuncs.com" , "db86w70r3yd4p04f" , "2735xuezu");

		if(!$link){
				echo "与数据库链接失败；";
				exit;
		}


		//step 2 select db
		mysql_select_db("db86w70r3yd4p04f");



?>





