<?php
	include ('templates/header.php');

require_once("pdo.php");


require_once("../core.php");




    session_start();
$id=$_SESSION['id'];

    if($_SESSION['login'])
    {
        echo "";
    }
    else 
     
    echo "  '<script>document.location.href = 'index.php'; </script>' "; 
   
	
	     
    
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

include ('templates/footer.php');

?>