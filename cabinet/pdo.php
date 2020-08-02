
<?php
$login = 'u396035837_alcs'; 
$pass = '147741qwE'; 
 
try {
    $db = new PDO('mysql:host=mysql.hostinger.com.ua;dbname=u396035837_alcs', $login, $pass);
   
   
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>