


<?php


require_once("../cabinet/pdo.php");


require_once("../core.php");



require_once("template/header2.php");


session_start();
if(!empty($_SESSION['admin_name']) and !empty($_SESSION['admin_id']) and !empty($_SESSION['admin_password'])) {
	
	echo '';
	}
	else
	
	
		   echo  " '<script>document.location.href = 'index.php'; </script>' 
		
  ";
	
	     
    $id= 'Admin ';
    $id_support= $_GET['id'];
    
    if (isset($_POST['text'])) 
    {
        $text=$_POST['text'];
         if ($text =='') 
         {
            unset($text);
            }
             }


   


               $textadd = $db->prepare("INSERT INTO supporttext (id_support,text,login) VALUES(:id_support,:text, :login) ");
  $textadd->bindParam(':id_support', $id_support);
    $textadd->bindParam(':text', $text);
        $textadd->bindParam(':login', $id);
    $textadd->execute();
unset($_POST['text']);
echo 'Вы успешно ответилиЖди редиректа?:)';
sleep(4);
header("Location: supporto.php?id=$id_support");
exit();

?>