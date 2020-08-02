<?php
	include ('templates/header.php');
    require ('pdo.php');
	include ('templates/menu_profile.php');
	
session_start();
$id=$_SESSION['id'];

    if($_SESSION['login'])
    {
        echo "";
    }
    else 
    
    echo "  '<script>document.location.href = 'index.php'; </script>' "; 
   
   


	if(isset($_POST['title']))
    {
        $title=$_POST['title'];
            }
			
	if(isset($_POST['login']))
    {
        $login=$_POST['login'];
	}
                
            
    
    
    if(isset($_POST['text']))
    {
        $text=$_POST['text'];
             }
     
     if (empty($title) or empty($text) or empty($login))
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    




    
    
    

    
    $statement = $db->prepare("SELECT * FROM support WHERE id_user=?");
    $statement->bindValue(1, $id, PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetch();
    if (!empty($result['id_user'])) {

    exit ("У вас уже имеется открытые тикеты!");
}



 $data= date("Y-m-d H:i:s");  

 
    $s = $db->prepare("INSERT INTO support (id_user,login,title,text,date) VALUES (:id_user, :login, :title, :text, :date)");
    $s->bindParam(':id_user', $id);
	$s->bindParam(':login', $login);
    $s->bindParam(':title', $title);
      $s->bindParam(':text', $text); 
    $s->bindParam(':date', $data);
    $s->execute();
    
    
    echo 'Ваш Тикет Успешно Создан!';
    $db=null;
	
	include ('templates/footer.php');
?>