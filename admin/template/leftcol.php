
		<div id="left">
			<div class="box statics">
				<div class="content">
					<ul>
						<li><h2>Статистика</h2></li>
						<li><font color='7ff241'>Серверов online</font><div class="info green"><span><?php echo $servers_total;?></span></div></li>
						<li>Обновление <div class="info black"><span><?php echo @date("d.m H:i", $settings['last_update']);?></span></div></li>
					</ul><br/>
				</div>

			</div>


			<div class="box statics">
				<div class="content">
					<ul>
						<li><h2>Меню</h2></li>
						<li><a href="/admin/add_news"><b>Добавить новость</b></a></li>
						<li><a href="/admin/support.php"><b>Тех.поддержка</b></a></li>

					</ul><br/>
				</div>

			</div>
					
		</div>