<?php
require_once("../cabinet/pdo.php");


require_once("../core.php");



require_once("template/header2.php");
    
?>

  <a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-th"></span> Мой профиль</a>
  <a href="support.php" class="btn btn-success"><span class="glyphicon glyphicon-headphones"></span> Тех. поддержка</a>
  <br><br>
  <h2></h2>

<?php
session_start();
if(!empty($_SESSION['admin_name']) and !empty($_SESSION['admin_id']) and !empty($_SESSION['admin_password'])) {
	
	echo '';
	}
	else
	
	
		   echo  " '<script>document.location.href = 'index.php'; </script>' 
		
  ";
   
     
    $id= 'Support ';
    $id_support= $_GET['id'];
 //   $login=$_SESSION['login'];
    
    

    
    
  $op = $db->prepare("SELECT * FROM support WHERE id=? ");
     $op->bindValue(1, $id_support, PDO::PARAM_INT);
        
    $op->execute();
$r = $op->fetch();
$row_count = $op->rowCount();
    if(($row_count)==0)
    {
       exit ("Ошибка!"); 
    }
    
  
    
    
$op = $db->prepare("SELECT * FROM support WHERE id=?");
    $op->bindValue(1, $id_support , PDO::PARAM_INT);
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
		<p>	<td> Сообщение от ".$row['login']."</td>

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
		<p>	<td> Сообщение от <font color='red'>".$row['login']."</font></td>

	</tr>
	<tr>
	<td><font color='green'><b>".$row['text']."</b><font></td> </p>
     
    
	</tr>
</table>


";
}    

   
   
    
   echo  "
   <br><h2></h2><br>
    <form action='supportok.php?id=$id_support'  method='post' />
   Ваше сообщение:
    <p> <input  type='text' class='form-control'  style='width:270' name='text' required >  </p>
    <button  name='submit'class='btn btn-primary btn-lg'>Отправить</button>

    ";
    
    
   require_once("template/footer2.php"); 
?>
   