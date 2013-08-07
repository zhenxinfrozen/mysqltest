<?php
		require "test.conf.php";

		//执行任何SQL
		//将所有语句分为两类，一类是有影响行数（update，delete，insert）的语句，
		$sql="CREATE TABLE if not exists loves(id int,name varchar(50) not null default '', old int not null default '0',desn text,primary key(id),key name(name,old))";

		$result=mysql_query($sql);

		//解决错误
		if(!$result){
				echo "ERROR " .mysql_errno()." :".mysql_error();
				exit;
		}
		var_dump($result);




		mysql_close();
?>


<?php
	echo "<br/>";
    mysql_connect("localhost", "root", "2735xuezu") or
        die("Could not connect: " . mysql_error());
    printf ("MySQL protocol version: %s\n", mysql_get_proto_info());
		mysql_close();
?>

<?php
	echo "<br/>";
    mysql_connect("localhost", "root", "2735xuezu") or
        die("Could not connect: " . mysql_error());
    printf ("MySQL host info: %s\n", mysql_get_host_info());
		mysql_close();
?>

<?php
	echo "<br/>";
    mysql_connect("localhost", "root", "2735xuezu") ;
$thread_id = mysql_thread_id($link);
if ($thread_id){
    printf ("current thread id is %d\n", $thread_id);
};
		mysql_close();
?>


<?php
	echo "<br/><br/>";
    mysql_connect("localhost", "root", "2735xuezu") ;
$db_list = mysql_list_dbs($link);

while ($row = mysql_fetch_object($db_list)) {
    echo $row->Database . "\n";
};
		mysql_close();
?>

<?php
	echo "<br/><br/>";
    mysql_connect("localhost", "root", "2735xuezu");
    $result = mysql_list_tables("fucktest");

    for ($i = 0; $i < mysql_num_rows($result); $i++)
        printf ("ray-----Table: %s\n", mysql_tablename($result, $i));
    echo "<br/>";

    mysql_free_result($result);
?>

<?php

$result = mysql_list_processes($link);
while ($row = mysql_fetch_assoc($result)){
    printf("%s %s %s %s %s\n", $row["Id"], $row["Host"], $row["db"],
       $row["Command"], $row["Time"]);
}
mysql_free_result ($result);
?>




<?php
	echo "<br/><br/><br/>MySQL version: <br/>";
    printf ("MySQL server version: %s\n", mysql_get_server_info());
?>



<?php

$fields = mysql_list_fields("fucktest", "fuck", $link);
$columns = mysql_num_fields($fields);

for ($i = 0; $i < $columns; $i++) {
    echo mysql_field_name($fields, $i) . "\n";
}









