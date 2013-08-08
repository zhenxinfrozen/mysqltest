<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php  
//上传文件类型列表  
$uptypes=array(  
    'image/jpg',  
    'image/jpeg',  
    'image/png',  
    'image/pjpeg',  
    'image/gif',  
    'image/bmp',  
    'image/x-png'  
);  
$max_file_size=2000000;     //上传文件大小限制, 单位BYTE  
$destination_folder="pic/"; //上传文件路径  
$watermark=1;      //是否附加水印(1为加水印,其他为不加水印);  
$watertype=1;      //水印类型(1为文字,2为图片)  
$waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);  
$waterstring="raytest--mysql";  //水印字符串  
$waterimg="xplore.gif";    //水印图片  
$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);  
$imgpreviewsize=1/2;    //缩略图比例  
?>  
<style type="text/css">  
<!--  
body  
{  
     font-size: 9pt;  
}  
input  
{  
     background-color: #66CCFF;  
     border: 1px inset #CCCCCC;  
}  
-->  
</style>  
</head>  


<?php
		//1连接数据库
		require "conf.php";

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
			echo '<div style=" margin:5px 5px;height:40px;">'.'关于：'.$about_she.'</div>';
			echo '<div style=" width:400px;height:600px;background:url('.$pic.') no-repeat center;text-align:center; margin:50px auto;">'.'</div>';
			echo '</div>';

		}

		echo '</div>';



?>


<form enctype="multipart/form-data" method="post" name="upform">  
  上传文件:  
	WHO: <input type="text" name="who" />
	TIME: <input type="text" name="time" />
	HOW: <input type="text" name="how" />
	<input name="upfile" type="file">  
	<input type="submit" value="上传"><br>  
	允许上传的文件类型为:<?=implode(', ',$uptypes)?>  
</form>  
  
<?php  
if ($_SERVER['REQUEST_METHOD'] == 'POST')  
{  
    if (!is_uploaded_file($_FILES["upfile"][tmp_name]))  
    //是否存在文件  
    {  
         echo "图片不存在!";  
         exit;  
    }  
  
    $file = $_FILES["upfile"];  
    if($max_file_size < $file["size"])  
    //检查文件大小  
    {  
        echo "文件太大!";  
        exit;  
    }  
  
    if(!in_array($file["type"], $uptypes))  
    //检查文件类型  
    {  
        echo "文件类型不符!".$file["type"];  
        exit;  
    }  
  
    if(!file_exists($destination_folder))  
    {  
        mkdir($destination_folder);  
    }  
  
    $filename=$file["tmp_name"];  
    $image_size = getimagesize($filename);  
    $pinfo=pathinfo($file["name"]);  
    $ftype=$pinfo['extension'];  
    $destination = $destination_folder.time().".".$ftype;  
    if (file_exists($destination) && $overwrite != true)  
    {  
        echo "同名文件已经存在了";  
        exit;  
    }  
  
    if(!move_uploaded_file ($filename, $destination))  
    {  
        echo "移动文件出错";  
        exit;  
    }  
  
    $pinfo=pathinfo($destination);  
    $fname=$pinfo[basename];  
    echo " <font color=red>已经成功上传</font><br>文件名:  <font color=blue>".$destination_folder.$fname."</font><br>";  
    echo " 宽度:".$image_size[0];  
    echo " 长度:".$image_size[1];  
    echo "<br> 大小:".$file["size"]." bytes";  
	
	
	if ($image_size[1]>0){
			$sql="INSERT INTO fuck (who, time, how, pic)
			VALUES
			('$_POST[who]','$_POST[time]','$_POST[how]','$destination')";
			if (!mysql_query($sql))
				{
				die('Error: ' . mysql_error());
					}
			echo "1 record added";
	}
	
  
    if($watermark==1)  
    {  
        $iinfo=getimagesize($destination,$iinfo);  
        $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);  
        $white=imagecolorallocate($nimage,255,255,255);  
        $black=imagecolorallocate($nimage,0,0,0);  
        $red=imagecolorallocate($nimage,255,0,0);  
        imagefill($nimage,0,0,$white);  
        switch ($iinfo[2])  
        {  
            case 1:  
            $simage =imagecreatefromgif($destination);  
            break;  
            case 2:  
            $simage =imagecreatefromjpeg($destination);  
            break;  
            case 3:  
            $simage =imagecreatefrompng($destination);  
            break;  
            case 6:  
            $simage =imagecreatefromwbmp($destination);  
            break;  
            default:  
            die("不支持的文件类型");  
            exit;  
        }  
  
        imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);  
        imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);  
  
        switch($watertype)  
        {  
            case 1:   //加水印字符串  
            imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);  
            break;  
            case 2:   //加水印图片  
            $simage1 =imagecreatefromgif("xplore.gif");  
            imagecopy($nimage,$simage1,0,0,0,0,85,15);  
            imagedestroy($simage1);  
            break;  
        }  
  
        switch ($iinfo[2])  
        {  
            case 1:  
            //imagegif($nimage, $destination);  
            imagejpeg($nimage, $destination);  
            break;  
            case 2:  
            imagejpeg($nimage, $destination);  
            break;  
            case 3:  
            imagepng($nimage, $destination);  
            break;  
            case 6:  
            imagewbmp($nimage, $destination);  
            //imagejpeg($nimage, $destination);  
            break;  
        }  
  
        //覆盖原上传文件  
        imagedestroy($nimage);  
        imagedestroy($simage);  
    }  
  
    if($imgpreview==1)  
    {  
			
    echo "<br>图片预览:<br>";  
    echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);  
    echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";  
	
    }  
}  
?>  


<?php


		echo '<div style="background:#6c0;width:100%;overflow:hidden;">' ;

			$sql="select who,time,how,pic,pid from fuck";

			$result=mysql_query($sql);

			


			while(list($who,$time,$how,$pic,$pid)=mysql_fetch_row($result)){
			echo '<div style="background:pink;width:200px;margin:5px; overflow:hidden; float:left; ">';
			echo '<div style="padding:10px 20px; font-size:40px;">'.$who.'</div>';
			echo '<div style="padding:10px 20px;">'.'语句评分：'.$time.'分'.'</div>';
			echo '<div style="padding:10px 20px;">'.'俗话说:<br/>'.$how.'<br/>----希特勒。'.'</div>';
			echo '<div style="width:100%; text-align:center;">'.'<img src="'.$pic.'" width=200></div>';
			echo '</div>';

			}
			echo '<div style="background:pink; height:500px;width:400px;margin:5px; overflow:hidden; float:left; ">';
			var_dump($result);
			echo '</div>';
		echo '</div>';

?>



<?php 

		
			$sql="INSERT INTO fuck (who, time, how, pid)
			VALUES
			('$_POST[who]','$_POST[time]','$_POST[how]','$destination')";
			if (!mysql_query($sql))
				{
				die('Error: ' . mysql_error());
					}
			echo "1 record added";
			mysql_close()

?>


</html>









