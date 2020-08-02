<?php
	include ('templates/header.php');
    require ('pdo.php');
	include ('templates/menu_profile.php');

	session_start();
     
        if($_SESSION['login'])
    {
        echo "";
    }
    else 
    
    echo "  '<script>document.location.href = 'index.php'; </script>' "; 
   
   
     
    $id=$_SESSION['id'];
    $id_support= $_GET['id'];
    $login=$_SESSION['login'];
    
    

    
    
  $op = $db->prepare("SELECT * FROM support WHERE id=? AND id_user=?");
     $op->bindValue(1, $id_support, PDO::PARAM_INT);
         $op->bindValue(2, $id, PDO::PARAM_STR);
    $op->execute();
$r = $op->fetch();
$row_count = $op->rowCount();
    if(($row_count)==0)
    {
       exit ("Ошибка!"); 
    }
    
  
    
    
$op = $db->prepare("SELECT * FROM support WHERE id_user=?");
    $op->bindValue(1, $id, PDO::PARAM_INT);
    $op->execute();
while($row = $op->fetch())
{
        echo " 
       
<table border='1' width='50%' width:100' cellpadding='3' cellspacing='3'>
<tr>
  <td>   Название тикета: ".$row['title']."</td>
</tr>

</table>

<table border='1' width='50%' width:100' cellpadding='3' cellspacing='3'>
	<tr>
		<p>	<td>Ваше Сообщение:</td>

	</tr>
	<tr>
	<td>".$row['text']."</td> </p>
     
    
	</tr>
</table>



        ";
    }
    
    $o = $db->prepare("SELECT * FROM  supporttext WHERE id_support=?");
    $o->bindValue(1, $id_support, PDO::PARAM_INT);
    $o->execute();
while($row = $o->fetch())
{
    echo "



<table border='1' width='50%' width:100' cellpadding='3' cellspacing='3'>
	<tr>
		<p>	<td> Сообщение от <font color='#B22222'><b>".$row['login']."</b></font></td>

	</tr>
	<tr>
	<td><font color='green'><b>".$row['text']."</b><font></td> </p>
     
    
	</tr>
</table>

";
}    

   
   
    
   echo  "
   <br><h2></h2><br>
    <form action='supportook.php?id=$id_support' method='post' />
	<font size='4'><font color='green'><b>Ваше сообщение:</b> </font></font>
    <p> <input  type='text' class='form-control'  style='width:270' name='text' required >  </p>
    <button  name='submit'class='btn btn-primary btn-lg'>Отправить</button>

    ";
    
  
	include ('templates/footer.php');
?>
   