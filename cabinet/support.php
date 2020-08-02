<?php
	include ('templates/header.php');
    require ('pdo.php');
	include ('templates/menu_profile.php');
?>

<center><font size="5"><font color="green"><b>Мои тикеты</b></font></font></center>
<br>
<h2></h2>


<?php

  




    session_start();
$id=$_SESSION['id'];

    if($_SESSION['login'])
    {
        echo "";
    }
    else 
     
    echo "  '<script>document.location.href = 'index.php'; </script>' "; 
   
   
      
      $p = $db->prepare("SELECT * FROM support WHERE id_user=?");
     $p->bindValue(1, $id, PDO::PARAM_INT);
    $p->execute();
$r = $p->fetch();
$row_count = $p->rowCount();
    if(($row_count)==0)
    {
      echo 'У вас нету созданных тикетов!';
    }

    

$id=$_SESSION['id'];

$tick = $db->prepare("SELECT * FROM support WHERE id_user=?");
    $tick->bindValue(1, $id, PDO::PARAM_INT);
    $tick->execute();
$tick->setFetchMode(PDO::FETCH_ASSOC);
while($row = $tick->fetch())
{

    echo " 
  <table width='100%'>
       <tr>
        <td># тикета</td>
        <td>Заголовк:</td>
        <td>Дата создание:</td> 
        <td></td> 
          <td> </td> 
    </tr>
    <tr>  
        <td>".$row['id']."</td>
        <td><span class='label label-important'> ".$row['title']."</span></td>
        <td>  <span class='label label-info'>".$row['date']."</span></td>
          <td>  <a href='supporto.php?id=".$row['id']." ' class='btn btn-small'>Перейти</a></td>
           <td>   <a href='delete.php?id=".$row['id']."' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span> Удалить</a> </td>
         
    </tr>
</table>
     
     

   ";
} 
$db=null;
?>


	
<h3>Открыть Новый Тикет:</h3>
<form action="supportopen.php" method="post"/>
Название тикета: 
<p> <input  type="text"   style="width:270"  class="form-control" name="title"/>  </p> 
Ваш логин: 
<?php
	@session_start();
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
	{
    // Если пусты,
    echo "";
    }
	else
    {
echo "
<p> <input  type='text'   style='width:270'  class='form-control' name='login' value='".$_SESSION['login']."'/>  </p> ";
	     }
    ?>
<!--<p> <input  type="text"   style="width:270"  class="form-control" name="name"/>  </p> !-->
Опишите вашу проблему!


<p> <textarea cols="15"   style="width:270" class="form-control" name="text" rows="5" wrap="virtual" maxlength="100"></textarea> </p>

<input type='submit' class="btn"/>
</form>

<?php
//Footer
	include ('templates/footer.php');
?>

