<?php
		//step 1 connect
		$link = mysql_connect("rzx.me" , "root" , "2735xuezu");

		if(!$link){
				echo "与数据库链接失败；";
				exit;
		}


		//step 2 select db
		mysql_select_db("mysqltest");



?>





