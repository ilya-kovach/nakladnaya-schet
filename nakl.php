<?php

include("./tcpdf/config/pdf_config.php");
include("./tcpdf/tcpdf.php");
//var r=15;

function num2str($num) {
	$nul='ноль';
	$ten=array(
		array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
		array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
	);
	$a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
	$tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
	$hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
	$unit=array( // Units
		array('копейка' ,'копейки' ,'копеек',	 1),
		array('рубль'   ,'рубля'   ,'рублей'    ,0),
		array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
		array('миллион' ,'миллиона','миллионов' ,0),
		array('миллиард','милиарда','миллиардов',0),
	);
	//
	list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
	$out = array();
	if (intval($rub)>0) {
		foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
			if (!intval($v)) continue;
			$uk = sizeof($unit)-$uk-1; // unit key
			$gender = $unit[$uk][3];
			list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
			// mega-logic
			$out[] = $hundred[$i1]; # 1xx-9xx
			if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
			else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
			// units without rub & kop
			if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
		} //foreach
	}
	else $out[] = $nul;
	$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
	$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
	return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

function morph($n, $f1, $f2, $f5) {
	$n = abs(intval($n)) % 100;
	if ($n>10 && $n<20) return $f5;
	$n = $n % 10;
	if ($n>1 && $n<5) return $f2;
	if ($n==1) return $f1;
	return $f5;
}

function numstr($nom_zapisey) {
	$vvv='';
	$ten=array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять');
	$a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
	$tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
	$hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
	$dlina=strlen($nom_zapisey); 
	if ($dlina==1){
		$vvv=$vvv.$ten[$nom_zapisey];
	}
	elseif ($dlina==2){
		$desyanti = substr($nom_zapisey, 0,1);
		if ($desyanti==1){
			$edinici = substr($nom_zapisey, 1,1);
			$vvv=$vvv.$a20[$edinici];
		} else{
		$edinici = substr($nom_zapisey, 1,1);
		$vvv=$vvv.$tens[$desyanti]." ".$ten[$edinici];}
	}
	elseif ($dlina==3){
		$sotni = substr($nom_zapisey, 0,1);
		$vvv=$vvv.$hundred[$sotni];
		$desyanti = substr($nom_zapisey, 1,1);
		if ($desyanti==1){
			$edinici = substr($nom_zapisey, 2,1);
			$vvv=$vvv." ".$a20[$edinici];
		} else{
		$edinici = substr($nom_zapisey, 2,1);
		$vvv=$vvv." ".$tens[$desyanti]." ".$ten[$edinici];}
	}
	return $vvv;
}

function generate_nakl_torg12()
{
	$style = array('width' => 0.1, 'color' => array(0, 0, 0));
	$style2 = array('width' => 0.7, 'color' => array(0, 0, 0));
	$style3 = array('width' => 0.4, 'color' => array(0, 0, 0));
    $name_pdf = ".out/nakl.pdf";
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8' );
    $pdf->_vendorinfo = "qwerty";
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0,0,0);
	$pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetDrawColor(0,0,0, false);
	
	
	$pdf->SetFont('freesans','',8);
	//Название фирмы
	$pdf->SetXY(9,9);
	$pdf->MultiCell(230, 0, $_POST['comment1'], 0, 'L');
	//Грузополучатель
	$pdf->SetXY(35,22.5);
	$pdf->MultiCell(215, 0, $_POST['comment2'], 0, 'L');
	//Поставщик
	$pdf->SetXY(35,35.5);
	$pdf->MultiCell(215, 0, $_POST['comment3'], 0, 'L');
	//Плательщик
	$pdf->SetXY(35,48.5);
	$pdf->MultiCell(215, 0, $_POST['comment4'], 0, 'L');
	//Дата создания ? возможно нужно перенести в другое место
	$pdf->SetFont('freesans', 'b', 10 );
	$pdf->SetXY(161,74);
	$pdf->Cell(22, 0, $_POST['data_sozdaniya'],0,0,'C');
	//Номер документа
	$pdf->SetFont('freesans', 'b', 10 );
	$pdf->SetXY(119,74);
	$pdf->Cell(22, 0, $_POST['nomer_dokгmenta'],0,0,'C');
	//ОКПО1
	$pdf->SetFont('freesans','',8);
	$pdf->SetXY(267,13.5);
	$pdf->Cell(1, 0, $_POST['OKPO'],0,0,'L');
	//ОКПО2
	$pdf->SetXY(267,36);
	$pdf->Cell(1, 0, $_POST['OKPO'],0,0,'L');
	//Форма по ОКУД
	$pdf->SetFont('freesans', 'b', 8 );
	$pdf->SetXY(268,9.5);
	$pdf->Cell(1, 0, $_POST['OKUD'],0,0,'L');
	
	
	$pdf->SetFont('freesans','',8);
	$pdf->SetXY(262,5.5);
	$pdf->Cell(22, 0, 'Код',0,0,'C');
	$pdf->SetXY(9,22);
	$pdf->Cell(22, 0, 'Грузополучатель',0,0,'L');
	$pdf->SetXY(9,35);
	$pdf->Cell(22, 0, 'Поставщик',0,0,'L');
	$pdf->SetXY(9,49);
	$pdf->Cell(22, 0, 'Плательщик',0,0,'L');
	$pdf->SetXY(9,61);
	$pdf->Cell(22, 0, 'Основание',0,0,'L');
	$pdf->SetXY(119,68.5);
	$pdf->Cell(22, 0, 'Номер документа',0,0,'C');	
	$pdf->SetXY(161,68.5);
	$pdf->Cell(22, 0, 'Дата составления',0,0,'C');
	$pdf->SetXY(228,9);
	$pdf->Cell(34, 0, 'Форма по ОКУД',0,0,'R');
	$pdf->SetXY(228,13);
	$pdf->Cell(34, 0, 'по ОКПО',0,0,'R');
	$pdf->SetXY(228,19.5);
	$pdf->Cell(34, 0, 'Вид деятельности по ОКДП',0,0,'R');
	$pdf->SetXY(228,26);
	$pdf->Cell(34, 0, 'по ОКПО',0,0,'R');
	$pdf->SetXY(228,35);
	$pdf->Cell(34, 0, 'по ОКПО',0,0,'R');
	$pdf->SetXY(228,48);
	$pdf->Cell(34, 0, 'по ОКПО',0,0,'R');
	$pdf->SetXY(228,53);
	$pdf->Cell(34, 0, 'номер',0,0,'R');
	$pdf->SetXY(228,58);
	$pdf->Cell(34, 0, 'дата',0,0,'R');
	$pdf->SetXY(228,63.5);
	$pdf->Cell(34, 0, 'номер',0,0,'R');
	$pdf->SetXY(228,68);
	$pdf->Cell(34, 0, 'дата',0,0,'R');
	$pdf->SetXY(228,73);
	$pdf->Cell(34, 0, 'Вид операции',0,0,'R');
	$pdf->SetXY(210,63.5);
	$pdf->Cell(1, 0, 'Транспортная накладная',0,0,'L');
	
	$pdf->SetFont('freesans', 'b', 15 );
	$pdf->SetXY(28,73);
	$pdf->Cell(1, 0, 'ТОВАРНАЯ НАКЛАДНАЯ',0,0,'L');
	
	$pdf->SetFont('freesans','',5.5);
	$pdf->SetXY(127,6);
	$pdf->Cell(1, 0, 'Унифицированная форма №ТОРГ-12 Утверждена постановлением Государственного комитета РФ по статистике от 25.12.1998 г. № 132',0,0,'L');
	$pdf->SetXY(103,18);
	$pdf->Cell(72, 0, 'организания - грузоотправитель,адрес,телефон,факс,банковские реквизиты',0,0,'C');	
	$pdf->SetXY(103,32);
	$pdf->Cell(72, 0, 'организания,адрес,телефон,факс,банковские реквизиты',0,0,'C');
	$pdf->SetXY(103,45);
	$pdf->Cell(72, 0, 'организания,адрес,телефон,факс,банковские реквизиты',0,0,'C');	
	$pdf->SetXY(103,58);
	$pdf->Cell(72, 0, 'организания,адрес,телефон,факс,банковские реквизиты',0,0,'C');	
	$pdf->SetXY(103,63);
	$pdf->Cell(72, 0, 'наименование документа(договор,контракт,заказ-наряд)',0,0,'C');	
	
	/*
	$pdf->SetFont('freesans','',10);
	$pdf->SetXY(50,140);
	$pdf->Cell(150, 0, 'дддддддддддддддд',1,2,'L');
	$pdf->Cell(150, 0, 'организания - грузоотправитель,адрес,телефон,факс,банковские реквизиты',1,2,'L');	
	$mmm = $pdf->GetY();
	//$pdf->Cell(150, 0, $mmm,1,2,'L');
	$pdf->line(50, $mmm, 2000, $mmm, $style);
	*/
	
	//$pdf->SetFont('freesansb','',10);
	//$pdf->SetXY(10,160);
    //$pdf->Cell(80, 0, 'qweqweqweqweqweqwe CELL STRETCH: no stretch', 1, 1, 'L', 0, '', 0);
	//$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
	// set cell padding
	//$pdf->setCellPaddings(1, 1, 1, 1);
	// set cell margins
	//$pdf->setCellMargins(1, 1, 1, 1);
	// set color for background
	//$pdf->SetFillColor(255, 255, 127);
	//pdf->MultiCell(80, 5, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);
	
    $pdf->line(9, 18, 285, 18, $style);
	$pdf->Line(34, 32, 285, 32, $style);
	$pdf->Line(34, 45, 285, 45, $style);
	$pdf->Line(34, 58, 285, 58, $style);
	$pdf->Line(34, 63, 285, 63, $style);
	$pdf->Line(262, 5, 262, 9, $style);
	$pdf->Line(285, 5, 285, 9, $style);
	$pdf->Line(262, 5, 285, 5, $style);
	$pdf->Rect(262, 9, 23, 68, 'D', array('all' => $style2));
	$pdf->Line(246, 53, 246, 73, $style);
	$pdf->Line(246, 53, 285, 53, $style);
	$pdf->Line(246, 73, 285, 73, $style);
	$pdf->Line(246, 68, 285, 68, $style);
	$pdf->Rect(110, 68, 82, 5, array('all' => $style1));
	$pdf->Rect(110, 73, 82, 7, 'D', array('all' => $style2));
	$pdf->Line(153, 68, 153, 73, $style);
	$pdf->Line(153, 73, 153, 80, $style2);
	$pdf->Line(262, 13, 285, 13, $style);
	$pdf->Line(262, 23, 285, 23, $style);
	
	$pdf->SetXY(8,82);
	$pdf->SetFont('freesans', 'b', 8 );
	$pdf->Cell(9, 8, '№ п/п',1,2,'C');
	$pdf->Cell(9, 4, '1',1,2,'C');
	$pdf->SetXY(17,82);
	$pdf->Cell(93, 4, 'Товар',1,2,'C');
	$pdf->SetXY(101,86);
	$pdf->Cell(9, 4, 'код',1,2,'C');
	$pdf->Cell(9, 4, '3',1,2,'C');
	
	$pdf->SetXY(17,86);
	$pdf->Cell(84, 4, 'наименование, характеристека, сорт, артикул',1,2,'C');
	$pdf->Cell(84, 4, '2',1,2,'C');
	$pdf->SetXY(110,82);
	$pdf->Cell(16, 4, 'Ед. изм.',1,2,'C');
	$pdf->Cell(8, 4, 'наи.',1,2,'C');
	$pdf->Cell(8, 4, '4',1,2,'C');
	$pdf->SetXY(118,86);
	$pdf->Cell(8, 4, 'Код',1,2,'C');
	$pdf->Cell(8, 4, '5',1,2,'C');
	$pdf->SetXY(134,82);
	$pdf->Cell(19, 4, 'Количество',1,2,'C');
	$pdf->SetXY(134,86);
	$pdf->Cell(9.5, 4, 'в 1 м.',1,2,'C');
	$pdf->Cell(9.5, 4, '7',1,2,'C');
	$pdf->SetXY(143.5,86);
	$pdf->Cell(9.5, 4, 'мест',1,2,'C');
	$pdf->Cell(9.5, 4, '8',1,2,'C');
	
	$pdf->MultiCell(8, 8, 'Вид упк',1,'C',false,2,126,82);
	$pdf->MultiCell(8, 4, '6',1,'C',false,2,126,90);
	$pdf->MultiCell(20, 8, 'Масса брутто',1,'C',false,2,153,82);
	$pdf->MultiCell(20, 4, '9',1,'C',false,2,153,90);
	$pdf->MultiCell(22, 8, 'Колличество (масса нетто)',1,'C',false,2,173,82);
	$pdf->MultiCell(22, 4, '10',1,'C',false,2,173,90);
	$pdf->MultiCell(20, 8, 'Цена руб.коп.',1,'C',false,2,195,82);
	$pdf->MultiCell(20, 4, '11',1,'C',false,2,195,90);
	$pdf->MultiCell(20, 8, 'Сумма без учета НДС',1,'C',false,2,215,82);
	$pdf->MultiCell(20, 4, '12',1,'C',false,2,215,90);
	$pdf->MultiCell(26, 4, 'НДС',1,'C',false,2,235,82);
	$pdf->MultiCell(6, 4, '%',1,'C',false,2,235,86);
	$pdf->MultiCell(6, 4, '13',1,'C',false,2,235,90);
	$pdf->MultiCell(20, 4, 'сумма',1,'C',false,2,241,86);
	$pdf->MultiCell(20, 4, '14',1,'C',false,2,241,90);
	$pdf->MultiCell(24, 8, 'Сумма с учетом НДС',1,'C',false,2,261,82);
	$pdf->MultiCell(24, 4, '15',1,'C',false,2,261,90);


	$data = $_POST['kolli4estvo_strok'];
	$mass[] = "";
	
	function massiv($data) {
	$mass[] = "";
	for ($d = 1; $d <= $data; $d++)
		{
			$txt = 'tovar-'.$d;
			$numm = $d.'-1';
			$mass[$numm] = $_POST[$txt];
			$txt = 'naimenovanie-'.$d;
			$numm = $d.'-2';
			$mass[$numm] = $_POST[$txt];
			$txt = 'kod-'.$d;
			$numm = $d.'-3';
			$mass[$numm] = $_POST[$txt];
			$txt = 'kolli4estvo-'.$d;
			$numm = $d.'-4';
			$mass[$numm] = $_POST[$txt];
			$txt = 'cena-'.$d;
			$numm = $d.'-5';
			$mass[$numm] = $_POST[$txt];
			$txt = 'bez_NDS-'.$d;
			$numm = $d.'-6';
			$mass[$numm] = $_POST[$txt];
			$txt = 's_NDS-'.$d;
			$numm = $d.'-7';
			$mass[$numm] = $_POST[$txt];
		}
	return $mass;
	}
	$mass = massiv($data);
	
	/*
	$record = array(
		"1-2" => 'Системный блок ПК Intel COre i5',
		"1-4" => 'шт.',
		"1-5" => '---',
		"1-10" => '1',
		"1-11" => '22000',
		"1-12" => '22000',
		"1-13" => '---',
		"1-14" => '0.00',
		"1-15" => '21000',
		"2-2" => 'Видеокарта Asus GeForce GTX 980 STRIX OC [STRIX-GTX980-DC2OC-4GD5]',
		"2-4" => 'шт.',
		"2-5" => '---',
		"2-10" => '1',
		"2-11" => '14000',
		"2-12" => '14000',
		"2-13" => '---',
		"2-14" => '0.00',
		"2-15" => '14000',
		"3-2" => 'Видеокарта Asus GeForce GTX 960 BLACK OC [GTX960-DC2OC-DC2OC-4GD5-BLACK]',
		"3-4" => 'шт.',
		"3-5" => '---',
		"3-10" => '2',
		"3-11" => '17000',
		"3-12" => '17000',
		"3-13" => '---',
		"3-14" => '0.00',
		"3-15" => '170000',
	);
	*/
	
	$y1 = 94;
	$y2 = $y1;
	for ($d = 1; $d <= $_POST['kolli4estvo_strok']; $d++)
	{
		$txt = $d."-1";
		$pdf->MultiCell(84,0,$mass[$txt],1,'L',false,2,17,$y2);
		$y1 = $y2;	
		$y2 = $pdf->GetY();
		$h=$y2-$y1;
		$pdf->SetXY(8,$y1);
		$pdf->Cell(9, $h, $d,1,2,'C');
		$pdf->SetXY(101,$y1);
		$pdf->Cell(9, $h, '',1,2,'C');
		$pdf->SetXY(110,$y1);
		$txt = $d."-2";
		$pdf->Cell(8, $h, $mass[$txt],1,2,'C');
		$pdf->SetXY(118,$y1);
		$txt = $d."-3";
		$pdf->Cell(8, $h, $mass[$txt],1,2,'C');
		$pdf->SetXY(126,$y1);
		$pdf->Cell(8, $h, '',1,2,'C');
		$pdf->SetXY(134,$y1);
		$pdf->Cell(9.5, $h, '',1,2,'C');
		$pdf->SetXY(143.5,$y1);
		$pdf->Cell(9.5, $h, '',1,2,'C');
		$pdf->SetXY(153,$y1);
		$pdf->Cell(20, $h, '',1,2,'C');
		$pdf->SetXY(173,$y1);
		$txt = $d."-4";
		$pdf->Cell(22, $h, $mass[$txt],1,2,'R');
		$pdf->SetXY(195,$y1);
		$txt = $d."-5";
		$pdf->Cell(20, $h, $mass[$txt],1,2,'R');
		$pdf->SetXY(215,$y1);
		$txt = $d."-6";
		$pdf->Cell(20, $h, $mass[$txt],1,2,'R');
		$pdf->SetXY(235,$y1);
		$txt = "---";
		$pdf->Cell(6, $h, $txt,1,2,'R');
		$pdf->SetXY(241,$y1);
		$txt = "0.00";
		$pdf->Cell(20, $h, $txt,1,2,'R');
		$pdf->SetXY(261,$y1);
		$txt = $d."-7";
		$pdf->Cell(24, $h, $mass[$txt],1,2,'R');
		if ($y2 > 195) {
			$pdf->AddPage();
			$y1 = 8;
			$y2 = 8;
		}
	}
	if ($y2 > 187) {
		$pdf->AddPage();
		$y1 = 8;
		$y2 = 8;
	}
	$sum = 0;
	for($i = 0; $i <= $data; ++$i) {
		$txt = $i."-4";
		$sum =$sum + $mass[$txt];
	}
	$pdf->SetXY(173,$y2);
	$pdf->Cell(22, 5, $sum,1,2,'R');
	$pdf->SetXY(195,$y2);
	$pdf->Cell(20, 5, 'X',1,2,'C');
	$pdf->SetXY(215,$y2);
	$sum = 0;
	for($i = 0; $i <= $data; ++$i) {
		$txt = $i."-6";
		$sum =$sum + $mass[$txt];
	}
	$pdf->Cell(20, 5, $sum,1,2,'R');
	$pdf->SetXY(235,$y2);
	$pdf->Cell(6, 5,'X',1,2,'C');
	$pdf->SetXY(241,$y2);
	
	$pdf->Cell(20, 5, "0",1,2,'R');
	$pdf->SetXY(115,$y2+1);
	$pdf->SetFont('freesans', 'b', 10 );
	$pdf->MultiCell(80, 0, 'Всего по накладной', 0, 'L');
	$pdf->SetXY(261,$y2);
	$sum = 0;
	for($i = 0; $i <= $data; ++$i) {
		$txt = $i."-7";
		$sum =$sum + $mass[$txt];
	}
	$pdf->Cell(24,5, $sum,1,2,'R');
	$y2 = $pdf->GetY();
	
	////
	$summa = num2str($sum);
	$summa2 = numstr($data);
	////
	
	$pdf->line(70, $y2+4.5, 285, $y2+4.5, $style);
	$pdf->line(26, $y2+8, 241, $y2+8, $style);
	$pdf->line(30, $y2+20, 115, $y2+20, $style);
	$pdf->line(160, $y2+15, 192, $y2+15, $style);
	$pdf->line(160, $y2+20, 192, $y2+20, $style);
	$pdf->Rect(195, $y2+9.5, 89, 5, 'D', array('all' => $style2));
	$pdf->Rect(195, $y2+14.5, 89, 5, 'D', array('all' => $style2));
	$pdf->SetFont('freesans','',8);
	$pdf->MultiCell(58, 15, 'Товарная накладная имеет приложение на и содержит',0,'L',false,2,9,$y2+1);
	$pdf->MultiCell(52, 1, 'порядковых номеров записей',0,'L',false,2,243,$y2+5);
	$pdf->MultiCell(137, 1, $summa2,0,'L',false,2,26,$y2+4.7);
	$pdf->SetFont('freesans','',5.5);
	$pdf->MultiCell(20, 1, 'прописью',0,'L',false,2,98,$y2+8.5);
	$pdf->MultiCell(85, 1, 'прописью',0,'C',false,2,30,$y2+20.5);
	$pdf->MultiCell(34, 1, 'прописью',0,'C',false,2,160,$y2+15.5);
	$pdf->MultiCell(34, 1, 'прописью',0,'C',false,2,160,$y2+20.5);
	$pdf->SetFont('freesans', '', 8 );
	$pdf->MultiCell(70, 1, 'Всего мест',0,'L',false,2,9,$y2+18);
	$pdf->MultiCell(70, 1, 'Масса груза(брутто)',0,'L',false,2,120,$y2+18);
	$pdf->MultiCell(70, 1, 'Масса груза(нетто)',0,'L',false,2,120,$y2+12);
	$y2 = $pdf->GetY()+10;
	if ($y2 > 166) {
		$pdf->AddPage();
		$y1 = 8;
		$y2 = 8;
	}
	$pdf->SetFont('freesans','b',10);
	$pdf->SetXY(243,$y2);
	$pdf->Cell(41, 6,'Без налога (НДС)',1,2,'C');
	$pdf->SetFont('freesans','',8);
	$pdf->MultiCell(137, 1, $summa,0,'L',false,2,9,$y2+9.7);
	$pdf->MultiCell(70, 15, 'Приложение (паспорта, сертификаты и т.п.) на Всего выпущенно не сумму',0,'L',false,2,9,$y2+1);
	$pdf->MultiCell(70, 15, 'листах',0,'L',false,2,136,$y2+1);
	$pdf->MultiCell(70, 15, 'Отпуск разрешил',0,'L',false,2,9,$y2+18);
	$pdf->MultiCell(70, 15, 'Отпуск произвел',0,'L',false,2,9,$y2+32);
	$pdf->MultiCell(200, 1, '<<             >>                                                         20                 г.',0,'L',false,2,52,$y2+39);
	$pdf->MultiCell(200, 1, '<<             >>                                                         20                 г.',0,'L',false,2,192,$y2+39);
	$pdf->MultiCell(200, 15, 'По доверенности №                                       от                                 г.',0,'L',false,2,151,$y2+4);
	$pdf->MultiCell(200, 15, 'Выданной',0,'L',false,2,151,$y2+10);
	$pdf->MultiCell(200, 15, 'Груз принял',0,'L',false,2,151,$y2+24);
	$pdf->MultiCell(200, 15, 'Груз получил',0,'L',false,2,151,$y2+30);
	$pdf->MultiCell(200, 15, 'грузополучатель',0,'L',false,2,151,$y2+34);
	$pdf->SetFont('freesans','',5.5);
	$pdf->MultiCell(20, 1, 'прописью',0,'L',false,2,100,$y2+5.5);
	$pdf->MultiCell(200, 1, 'должность',0,'L',false,2,48,$y2+22.5);
	$pdf->MultiCell(200, 1, 'должность',0,'L',false,2,48,$y2+35.5);
	$pdf->MultiCell(200, 1, 'подпись',0,'L',false,2,83,$y2+22.5);
	$pdf->MultiCell(200, 1, 'подпись',0,'L',false,2,83,$y2+28.5);
	$pdf->MultiCell(200, 1, 'подпись',0,'L',false,2,83,$y2+35.5);
	$pdf->MultiCell(200, 1, 'расшифровка подписи',0,'L',false,2,113,$y2+22.5);
	$pdf->MultiCell(200, 1, 'расшифровка подписи',0,'L',false,2,113,$y2+28.5);
	$pdf->MultiCell(200, 1, 'расшифровка подписи',0,'L',false,2,113,$y2+35.5);
	$pdf->MultiCell(200, 1, 'должность',0,'L',false,2,189,$y2+26.5);
	$pdf->MultiCell(200, 1, 'должность',0,'L',false,2,189,$y2+35.5);
	$pdf->MultiCell(200, 1, 'подпись',0,'L',false,2,224,$y2+26.5);
	$pdf->MultiCell(200, 1, 'подпись',0,'L',false,2,224,$y2+35.5);
	$pdf->MultiCell(200, 1, 'расшифровка подписи',0,'L',false,2,254,$y2+26.5);
	$pdf->MultiCell(200, 1, 'расшифровка подписи',0,'L',false,2,254,$y2+35.5);
	$pdf->SetFont('freesans', 'b', 8 );
	$pdf->MultiCell(200, 1, $_POST['otpusk_razreshil'],0,'L',false,2,35,$y2+18);
	$pdf->MultiCell(43, 1, $_POST['name1'],0,'R',false,2,103,$y2+18);
	$pdf->MultiCell(43, 1, $_POST['name2'],0,'R',false,2,103,$y2+24.5);
	$pdf->MultiCell(43, 1, $_POST['name3'],0,'R',false,2,103,$y2+31);
	$pdf->MultiCell(200, 1, $_POST['otpusk_proisvel'],0,'L',false,2,35,$y2+31.5);
	$pdf->MultiCell(200, 1, 'Главный (старший) бугалтер',0,'L',false,2,9,$y2+25.5);
	$pdf->MultiCell(200, 1, 'М.П.',0,'L',false,2,18,$y2+39);
	$pdf->MultiCell(200, 1, 'М.П.',0,'L',false,2,158,$y2+39);
	$pdf->line(148, $y2+1, 148, $y2+43, $style);
	$pdf->line(75, $y2+5, 135, $y2+5, $style);
	$pdf->line(9, $y2+13, 145, $y2+13, $style);
	$pdf->line(9, $y2+16, 145, $y2+16, $style);
	$pdf->line(35, $y2+22, 70, $y2+22, $style);
	$pdf->line(35, $y2+35, 70, $y2+35, $style);
	$pdf->line(73, $y2+22, 100, $y2+22, $style);
	$pdf->line(73, $y2+28, 100, $y2+28, $style);
	$pdf->line(73, $y2+35, 100, $y2+35, $style);
	$pdf->line(103, $y2+22, 145, $y2+22, $style);
	$pdf->line(103, $y2+28, 145, $y2+28, $style);
	$pdf->line(103, $y2+35, 145, $y2+35, $style);
	$pdf->line(57, $y2+42, 65, $y2+42, $style);
	$pdf->line(68, $y2+42, 107, $y2+42, $style);
	$pdf->line(113, $y2+42, 123, $y2+42, $style);
	$pdf->line(197, $y2+42, 205, $y2+42, $style);
	$pdf->line(208, $y2+42, 247, $y2+42, $style);
	$pdf->line(253, $y2+42, 263, $y2+42, $style);
	$pdf->line(180, $y2+8, 203, $y2+8, $style);
	$pdf->line(210, $y2+8, 230, $y2+8, $style);
	$pdf->line(167, $y2+13, 285, $y2+13, $style);
	$pdf->line(167, $y2+19, 285, $y2+19, $style);
	$pdf->line(175, $y2+26, 211, $y2+26, $style);
	$pdf->line(175, $y2+35, 211, $y2+35, $style);
	$pdf->line(214, $y2+26, 242, $y2+26, $style);
	$pdf->line(214, $y2+35, 242, $y2+35, $style);
	$pdf->line(245, $y2+26, 285, $y2+26, $style);
	$pdf->line(245, $y2+35, 285, $y2+35, $style);
	
	
	
    $pdf->Output( $name_pdf ,'I');
	
    return $name_pdf;
}

generate_nakl_torg12();
?>

<p>hello!</p>
<a href="out/nakl.pdf">Take PDF document!</a>
