<?php
	include ('templates/header.php');
   require ('pdo.php');
    include ('templates/menu_profile.php');
?>

<?php
	
	session_start();
        
    $id=$_SESSION['id'];
    $login=$_SESSION['login'];	


   
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
    // Если пусты, то мы не выводим ссылку

		echo  " <script>document.location.href = 'index.php'; </script> ";
    }
    else
    {

    // Если не пусты, то мы выводим ссылку
    echo " ";

    }
    ?>
<br><br>
<?php
	//Профиль 
    $pr=$db->prepare("SELECT * FROM users WHERE id=?");
    $pr->bindValue(1, $id, PDO::PARAM_INT);
    $pr->execute();
    while($row = $pr->fetch())
    {
        echo " 
             
		<center>
		<img src='/images/no_ava.png'><br>
		<font color='white'>Приветствуем</font> <font color='red'><b>".$_SESSION['login']." </b></font>
		</center><br>
		<font size='4'><font color='white'>
		Имя: <font color='red'><b>".$_SESSION['name']." </b></font><br>
		Фамилия: <font color='red'><b>".$_SESSION['names']." </b></font><br>
		Email: <font color='red'><b>".$_SESSION['email']." </b></font><br>
		</font></font>
		<font size='3'>
		<a href='edit_profile.php'>[Редагувати]</a>
		</font>
		";
	}
$db =null;
?>

<?php

include ('templates/footer.php');

?>

