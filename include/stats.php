<?php 
if (! defined ( 'BOOST' )) { exit ( "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> Эй, не озоруй. К данному файлу я тебе запрещаю прямой доступ. Теперь-то мне ясно, кто ковыряет мой сайт." ); }
?>

	<script src="main/js/jq.js"></script>
	<script type="text/javascript">
	$(function () {
		var chart;
		$(document).ready(function() {
		chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container', type: 'line'
		},
		title: {
			text: 'Запросы к мастерсерверу'
		},
		subtitle: {
			text: 'за последние 7 дней'
		},
		xAxis: {
			categories: ['6 дней назад', '5 дней назад', '4 дня назад', '3 дня назад', '2 дня назад', 'Вчера', 'Сегодня']
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Количество IP адресов'
			}
		},
		legend: {
			layout: 'vertical',	backgroundColor: '#FFFFFF', align: 'left', verticalAlign: 'top', x: 100, y: 70, floating: true, shadow: true
		},
		tooltip: {
			formatter: function() {
				return this.y +' игрока(ов)';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2, borderWidth: 0
			}
		},
		series: [{
		name: 'Уникальные запросы CS 1.6',
		<?php 
			for ($x=0; $x<=6; $x++) {
				$m = (date("m", strtotime("-".$x." day")));
				$m2 = (date("Y", strtotime("-".$x." day"))); 
				$m3 = (date("d", strtotime("-".$x." day")));
				$sql = mysql_query("SELECT COUNT(DISTINCT CONCAT(`ip`,':',`port`)) AS `unique` FROM `mslog` WHERE timeyear = $m2 and timemonth = $m and timeday = $m3 and type = 'cs'") or die(mysql_error());
				$row = mysql_fetch_row($sql);
				$count_uq16[] = $row[0];
			}
			echo "data: [";
			$uq_reverse = array_reverse($count_uq16);
			echo implode(", ",$uq_reverse);
			echo "]";
		?>
		}]
		});
		});

	});
	</script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
	<div id="container" style="min-width: 500px; height: 300px; margin: 0 auto"></div>