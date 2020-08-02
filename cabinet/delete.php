

<?php
	include ('templates/header.php');
require_once ('pdo.php');

	?>
    
<? require_once ('templates/menu_profile.php'); ?>

    
    
    <?php
	
session_start();

if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
  
    echo  " '<script>document.location.href = 'index.php'; </script>' ";
    }
    else

    echo " ";

$id=$_SESSION['id'];
	//Функция для удаление тикетов
    $id_support=(int)$_GET['id'];
    
    
      $op = $db->prepare("SELECT * FROM support WHERE id=? AND id_user=?");
     $op->bindValue(1, $id_support, PDO::PARAM_INT);
         $op->bindValue(2, $id, PDO::PARAM_STR);
    $op->execute();
$r = $op->fetch();
$row_count = $op->rowCount();
    if(($row_count)==0)
    {
    //   exit ("Ошибка!"); 
	   
echo '<p><center><font size="6"><font color="red"><b>Ошибка!</b></font></font></center></p>';
  //  
}
//

$stmt = $db->prepare("DELETE FROM support WHERE id=?");
$stmt->bindValue(1, $id_support, PDO::PARAM_INT);
$stmt->execute();

echo '<center><font size="6"><font color="green"><b>Ваш Тикет Успешно Удален!</b></font></font></center>';
//echo "<p>Ваш Тикет Успешно Удален!</p>";
//
include ('templates/footer.php');
?>
