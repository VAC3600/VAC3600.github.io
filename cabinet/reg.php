<?php
//Шаблон Личного Кабинета!
	require_once ('templates/header.php');
    
    session_start();    
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
    // Если пусты, то мы не выводим ссылку
    echo '
		<br><center><font size="6"><font color="green"><b>РЕГИСТРАЦИЯ</b></font></font></center><br>
	<h2></h2>
	<center>
  <form action="/cabinet/validate.php" method="post">

    <label>Введите логин:<br></label>
    <input name="login"   style="width:270" class="form-control" type="text" size="15" maxlength="20">
    </p>

<p>
   <label>Введите E-mail:<br></label>
    <input name="email"   style="width:270" class="form-control" type="text" size="15" maxlength="50">
    </p>

<p>
   <label>Введите Фамилию:<br></label>
    <input name="names"   style="width:270" class="form-control" type="text" size="15" maxlength="50">
    </p>
	<p>
   <label>Введите Имя:<br></label>
    <input name="name"   style="width:270" class="form-control" type="text" size="15" maxlength="50">
    </p>

<p>
    <label>Введите пароль:<br></label>
    <input name="password"   style="width:270" class="form-control" type="password" size="15" maxlength="20">
    </p>

<p>

<input type="submit" class="btn btn-success" value="Зарегистрироваться"/>
</p></form></center>
';
    }
    else
    {

    // Если не пусты, то мы выводим ссылку
    echo'
		<br><center><font size="6"><font color="green"><b>РЕГИСТРАЦИЯ</b></font></font></center><br>
	<h2></h2>
	<br>
		<center>
		<a class="btn btn-danger">
		<span class="glyphicon glyphicon-off"></span>
		Вы вошли на сайт, как зарегистрированный пользователь!
		</a><br>
		</center>

            ';
  
    
    }
    ?>



    </header><section id="page-messages" class="container"></section><section id="page-content" class="container">
		
        
          <form action="/cabinet/validate.php" method="post">
   
    
    </body>
    </html>
		<?require_once ('templates/footer.php');?>