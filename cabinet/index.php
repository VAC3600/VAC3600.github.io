 <html>
    <head>
    <title>Страница авторизации</title>
    </head>
    <body>


<?php
//Шаблон Личного Кабинета!
include ('templates/header.php');

    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    //Старт сессии :)
    session_start();
    
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
    // Если пусты, то мы не выводим ссылку
    echo '    
	<br><center><font size="6"><font color="green"><b>СТРАНИЦА АВТОРИЗАЦИИ</b></font></font></center><br>
	<h2></h2>
	<center>
    <form action="/cabinet/validate_login.php" method="post">
 <p>
    <label>Введите логин:<br></label>
    <input name="login"   style="width:270" class="form-control" type="text" size="15" maxlength="15">
    </p>
    
  <p>
    <label>Введите пароль:<br></label>
    <input name="password"  style="width:270" class="form-control" type="password" size="15" maxlength="15">
    </p>

<p>
<input type="submit" class="btn btn-success btn-lg" value="Войти"/>


<a href="reg.php" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-user"></span>  Зарегистрироваться</a>
    </p></form></center>';
    }
    else
    {

    // Если не пусты, то мы выводим ссылку
    echo "
    <div class='alert alert-error'>
  <button type='button' class='close' data-dismiss='alert'>?</button>
  <h4>Внимание!</h4>
  Вы уже Авторизованы
</div>";
    }
    ?>
    
    
    <?php
//Footer
	include ('templates/footer.php');
?>
   