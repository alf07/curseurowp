
function cureuro_func($atts, $content ){
	$xml = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
	$percent = "5"; // Процент
	$cur_data = date("d.m.y");

	foreach ($xml->Valute as $one) {
		if ($one["ID"] == 'R01239') { //выбираем евро по коду цб
			$koeficient1 = round(str_replace(',','.',$one->Value), 4); //ее значение
			$number_percent = $koeficient1 / 100 * $percent;
			$procent_plus = $koeficient1 + $number_percent;
			$procent_plus_r = round($procent_plus, 4);
			$koeficient2 = $one->Nominal.' '.$one->Name.' = '.$procent_plus_r.' руб. от '.$cur_data; //запоминаем номинал
		} 
	}
	return $koeficient2;
}
