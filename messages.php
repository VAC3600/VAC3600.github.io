<?php
/*
 * Message display script
 * Made by starky
*/

/* Script security */
if(!defined("MONENGINE")) {
	header("Location: index.php");
	exit();
}
/* Other code */

/* Templates */
$styles = Array(
	'error'		=> 'msg redbg',
	'warning'	=> 'warning-yellow',
	'info'		=> 'warning-blue',
	'success'	=> 'msg greenbg'
);

$codes	= Array(
	404			=> Array('error', '<center><a class="btn btn-danger">
		<span class="glyphicon glyphicon-off"></span>
		Данная страница не существует, либо она была удалена.
		</a></center><br>'),
	000			=> Array('error', 'Произошла неизвестная ошибка.')
);

if(!isset($msg_code) or empty($codes[$msg_code])) $msg_code = 000;

echo "<div class='{$styles[$codes[$msg_code][0]]}'>{$codes[$msg_code][1]}</div>";
echo "<table width='100%' height='150'>
			<tr><td valign='middle'>
				<td align='center' style='font-size:16px;'><a href='/'>Вернуться на главную страницу</a></td>
			</td></tr>
		</table>
";
?>