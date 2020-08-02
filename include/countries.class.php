<?php
class countries {
	var $matches = Array();
	var $countries = Array(
	"ru" => "Россия",
	"ua" => "Україна",
	"az" => "Азербайджан",
	"kz" => "Казахстан",
	"md" => "Молдова",
	);
		
	function makeSelect($qresult, $total_option = true) {
		$this->getMatches($qresult);
		global $servers_total;
		$result = "<select name='country'>";
		if($total_option) $result .= "<option value='all' selected>Все страны </option>";
		foreach($this->countries as $key => $name) {
			if(isset($this->matches[$key])) {
				$cur_matches = $this->matches[$key];
			} else {
				$cur_matches = 0;
			}
			
			if($cur_matches != 0) $result .= "<option value='$key'>$name </option>\n";
		}
		$result .= "</select>";
		echo $result;
	}
	
	
	function getMatches($qresult) {
		while($server = dbarray_fetch($qresult)) {
				if(empty($matches[$server['server_location']])) {
					$this->matches[strtolower($server['server_location'])] = 1;
				} else {
					$this->matches[strtolower($server['server_location'])]++;
				}
		}
	}

}
?>