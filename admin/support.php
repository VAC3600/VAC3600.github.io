<?php
//бд
require_once("../cabinet/pdo.php");


require_once("../core.php");



require_once("template/header2.php");


session_start();
if(!empty($_SESSION['admin_name']) and !empty($_SESSION['admin_id']) and !empty($_SESSION['admin_password'])) {
	
	echo "<table border='1' width='50%' width:100' cellpadding='3' cellspacing='3'>
 <tr>
        <td><center><span class='label label-info'>№</span></center></td>
        <td><center><span class='label label-primary'>Заголовок</span></center></td>
		<td><center><span class='label label-primary'>ID USER</span></center></td>
        <td><center><span class='label label-info'>Дата создание</span></center></td> 
        <td><br><br></td> 
          <td> </td> 
    </tr> ";
	}
	else
	
	
		   echo  " '<script>document.location.href = 'index.php'; </script>' 
		
  ";

	 

$t= $db->query("SELECT * FROM support");
while($r=$t->fetch())
{
echo " 
  

 
  

    <tr>  

        <td><center><span class='label label-info'> ".$r['id']." </span></center></td>
        <td><span class='label label-primary'> ".$r['title']."</span></td>
 <td>  <center><span class='label label-primary'>".$r['id_user']."</span></center></td>
        <td>  <span class='label label-info'>".$r['date']."</span></td>
          <td>  <a href='supporto.php?id=".$r['id']." ' class='btn btn-small'>Перейти</a></td>
           <td>   <a href='delete.php?id=".$r['id']."' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span> Удалить</a> </td>
         
    </tr>

     




   ";
}
echo "</table>";
require_once("template/footer2.php");
?>
