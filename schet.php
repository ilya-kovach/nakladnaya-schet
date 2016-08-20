<?php

include("./tcpdf/config/pdf_config.php");
include("./tcpdf/tcpdf.php");
//var r=15;

function generate_schet_torg12()
{
	$style = array('width' => 0.1, 'color' => array(0, 0, 0));
	$name_pdf = ".out/schet.pdf";
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8' );
    $pdf->_vendorinfo = "qwerty";
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0,0,0);
	$pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetDrawColor(0,0,0, false);
	
	$pdf->SetFont('freesans','',8);
	//продавец
	$pdf->MultiCell(250, 0, 'ООО "РОГА И КОПЫТА" (ООО "РОГА И КОПЫТА")',0,'L',false,0,37,19.5);
	//адрес
	$pdf->MultiCell(250, 0, 'Переулок 25й Новый,10, г.Мосва,Московская обл. 347917)',0,'L',false,0,37,24.5);
	//ИНН продавца
	$inn_prod='6154111030';
	//КПП продавца
	$kpp_prod='615401001';
	//Грузополучатель и его адрес
	$pdf->MultiCell(210, 0, 'ОАО"Научно-исследовательский институт "Сантол",',0,'L',false,0,71,40);
	//к платежно-расчетному документу
	$pdf->MultiCell(210, 0, '№ -------- от -- -- ---- г.',0,'L',false,0,79,49.5);
	//покупатель
	$pdf->MultiCell(250, 0, 'ОАО"Научно-исследовательский институт "Сантол"',0,'L',false,0,37,55);
	//ИНН покупателя
	$inn_poc='5010011378';
	//КПП покупателя
	$kpp_poc='5010011301';
	//наименование валюты 
	$pdf->MultiCell(50, 0, 'Российский рубль',0,'L',false,0,250,67);
	//Руководитель организации
	$rukovoditel_org='Иванов И.И.';
	//Глвный бугалтер
	$glavni_bugalter='Иванова И.И.';
	
	$record = array(
		"1-1" => 'Ethernet Shield+EPCS sdf sdf ffsdffsdf  wefwefwefwef fweef  fw',
		"1-3" => '4',
		"1-4" => '800.00',
		"1-5" => '3200.00',
		"1-8" => '0.01',
		"1-9" => '3200.00',
		"2-1" => 'Доставка почтой России',
		"2-3" => '1',
		"2-4" => '250.00',
		"2-5" => '250.00',
		"2-8" => '0.03',
		"2-9" => '250.00',
	);
	
	$dlina=strlen($inn_prod); 
	$pdf->SetFont('freesans','',8);
	$pdf->MultiCell(5, 5, $inn_prod{0},1,'C',false,0,71,30,false,0,false,false,0,'M');
	for ($d = 1; $d <= 11; $d++)
	{
		if ($d < $dlina) {
			$pdf->MultiCell(5, 5, $inn_prod{$d},1,'C',false,0,71+$d*5,30,false,0,false,false,0,'M');
		} else {
			$pdf->MultiCell(5, 5, ' ',1,'C',false,0,71+$d*5,30,false,0,false,false,0,'M');
		}
	}
	
	$dlina=strlen($kpp_prod); 
	$pdf->SetFont('freesans','',8);
	$pdf->MultiCell(5, 5, $kpp_prod{0},1,'C',false,0,145,30,false,0,false,false,0,'M');
	for ($d = 1; $d <= 8; $d++)
	{
		if ($d < $dlina) {
			$pdf->MultiCell(5, 5, $kpp_prod{$d},1,'C',false,0,145+$d*5,30,false,0,false,false,0,'M');
		} else {
			$pdf->MultiCell(5, 5, ' ',1,'C',false,0,145+$d*5,30,false,0,false,false,0,'M');
		}
	}
	
	$dlina=strlen($inn_poc); 
	$pdf->SetFont('freesans','',8);
	$pdf->MultiCell(5, 5, $inn_poc{0},1,'C',false,0,71,66,false,0,false,false,0,'M');
	for ($d = 1; $d <= 11; $d++)
	{
		if ($d < $dlina) {
			$pdf->MultiCell(5, 5, $inn_poc{$d},1,'C',false,0,71+$d*5,66,false,0,false,false,0,'M');
		} else {
			$pdf->MultiCell(5, 5, ' ',1,'C',false,0,71+$d*5,66,false,0,false,false,0,'M');
		}
	}
	
	$dlina=strlen($kpp_poc); 
	$pdf->SetFont('freesans','',8);
	$pdf->MultiCell(5, 5, $kpp_poc{0},1,'C',false,0,145,66,false,0,false,false,0,'M');
	for ($d = 1; $d <= 8; $d++)
	{
		if ($d < $dlina) {
			$pdf->MultiCell(5, 5, $kpp_poc{$d},1,'C',false,0,145+$d*5,66,false,0,false,false,0,'M');
		} else {
			$pdf->MultiCell(5, 5, ' ',1,'C',false,0,145+$d*5,66,false,0,false,false,0,'M');
		}
	}
	
	$pdf->SetFont('freesans','',4);
	$pdf->MultiCell(130, 0, 'Положение №1 к Правилам ведения журналов учета полученных и выставленных счетов-фактур, книг покупок и книг продаж при расчетах по налогу на добавленную стоимость,утвержденным постановлением Правительства РФ от 2 декабря 2000г. №914(в редакции постановлений Правительства РФ от 15.03.2001 г. №189, от 27.07.2002 г. №575, от 16.02.2004 г. №84, от 11.05.2006 г. №451)',0,'L',false,0,158,8);
	
	$pdf->SetFont('freesans','b',14.5);
	$pdf->MultiCell(135, 0, 'СЧЕТ-ФАКТУРА № 00000514 от "18" февраля 2016 г.',0,'L',false,0,80,12);
	
	$pdf->SetFont('freesans','', 8 );
	$pdf->MultiCell(60, 0, 'Продавец',0,'L',false,0,14,20);
	$pdf->MultiCell(60, 0, 'Адрес',0,'L',false,0,14,25);
	$pdf->MultiCell(60, 0, 'ИНН / КПП продавца',0,'L',false,0,14,30);
	$pdf->MultiCell(60, 0, 'Грузоотправитель и его адрес',0,'L',false,0,14,35);
	$pdf->MultiCell(60, 0, 'Грузополучатель и его адрес',0,'L',false,0,14,40);
	$pdf->MultiCell(60, 0, 'К платежно-расчетному документу',0,'L',false,0,14,50);
	$pdf->MultiCell(60, 0, 'Покупатель',0,'L',false,0,14,55);
	$pdf->MultiCell(60, 0, 'Адрес',0,'L',false,0,14,61);
	$pdf->MultiCell(60, 0, 'ИНН / КПП покупателя',0,'L',false,0,14,66);
	$pdf->MultiCell(65, 0, 'Наименование валюты: ',0,'L',false,0,220,67);
	
	$pdf->SetFont('freesans','', 12 );
	$pdf->MultiCell(65, 0, '/',0,'L',false,0,137,30);
	$pdf->MultiCell(65, 0, '/',0,'L',false,0,137,66);
	
	$pdf->line(37, 23, 281, 23, $style);
	$pdf->line(37, 28, 281, 28, $style);
	$pdf->line(71, 38.5, 281, 38.5, $style);
	$pdf->line(71, 43.5, 281, 43.5, $style);
	$pdf->line(71, 47, 281, 47, $style);
	$pdf->line(79, 53, 281, 53, $style);
	$pdf->line(37, 58.5, 281, 58.5, $style);
	$pdf->line(37, 63.5, 281, 63.5, $style);
	
	$pdf->SetFont('freesans','', 7 );
	$pdf->MultiCell(64, 12.5, 'Наименование товара (описание выполненных работ, оказанных услуг), имущественного права',1,'C',false,0,13,72);
	$pdf->MultiCell(8, 12.5, 'Ед. изм',1,'C',false,0);
	$pdf->MultiCell(20, 12.5, 'Количество',1,'C',false,0);
	$pdf->MultiCell(20, 12.5, 'Цена (тариф) за единицу измерения',1,'C',false,0);
	$pdf->MultiCell(26, 12.5, 'Стоимость товаров (работ, услуг), иму- щественных прав, всего без налога',1,'C',false,0);
	$pdf->MultiCell(8, 12.5, 'В т.ч. акциз',1,'C',false,0);
	$pdf->MultiCell(16, 12.5, 'Налоговая ставка',1,'C',false,0);
	$pdf->MultiCell(19, 12.5, 'Сумма налога',1,'C',false,0);
	$pdf->MultiCell(26, 12.5, 'Стоимость товаров (работ, услуг), иму- ществ. прав, всего с учетом налога',1,'C',false,0);
	$pdf->MultiCell(18, 12.5, 'Страна происхождения',1,'C',false,0);
	$pdf->MultiCell(45, 12.5, 'Номер таможенной декларации',1,'C',false,0);
	$pdf->MultiCell(64, 4, '1',1,'C',false,0,13,84.5);
	$pdf->MultiCell(8, 4, '2',1,'C',false,0);
	$pdf->MultiCell(20, 4, '3',1,'C',false,0);
	$pdf->MultiCell(20, 4, '4',1,'C',false,0);
	$pdf->MultiCell(26, 4, '5',1,'C',false,0);
	$pdf->MultiCell(8, 4, '6',1,'C',false,0);
	$pdf->MultiCell(16, 4, '7',1,'C',false,0);
	$pdf->MultiCell(19, 4, '8',1,'C',false,0);
	$pdf->MultiCell(26, 4, '9',1,'C',false,0);
	$pdf->MultiCell(18, 4, '10',1,'C',false,0);
	$pdf->MultiCell(45, 4, '11',1,'C',false,0);
	
	$n=2;
	$y1 = 88.5;
	$y2 = $y1;
	for ($d = 1; $d <= $n; $d++)
	{
		$txt = $d."-1";
		$pdf->MultiCell(64,0,$record[$txt],1,'L',false,2,13,$y2);
		$y1 = $y2;	
		$y2 = $pdf->GetY();
		$h=$y2-$y1;
		$pdf->MultiCell(8,$h,'шт.',1,'C',false,0,77,$y1);
		$txt = $d."-3";
		$pdf->MultiCell(20,$h,$record[$txt],1,'R',false,0,85,$y1);
		$txt = $d."-4";
		$pdf->MultiCell(20,$h,$record[$txt],1,'R',false,0,105,$y1);
		$txt = $d."-5";
		$pdf->MultiCell(26,$h,$record[$txt],1,'R',false,0,125,$y1);
		$pdf->MultiCell(8,$h,'-',1,'C',false,0,151,$y1);
		$pdf->MultiCell(16,$h,'-------',1,'R',false,0,159,$y1);
		$txt = $d."-8";
		$pdf->MultiCell(19,$h,$record[$txt],1,'R',false,0,175,$y1);
		$txt = $d."-9";
		$pdf->MultiCell(26,$h,$record[$txt],1,'R',false,0,194,$y1);
		$pdf->MultiCell(18,$h,'Россия',1,'L',false,0,220,$y1);
		$pdf->MultiCell(45,$h,'--------',1,'L',false,0,238,$y1);
		if ($y2 > 195) {
			$pdf->AddPage();
			$y1 = 8;
			$y2 = 8;
		}
	}
	$pdf->SetFont('freesans','b', 8 );
	$pdf->MultiCell(181,4,'Всего к оплате',1,'L',false,0,13,$y2);
	$pdf->SetFont('freesans','', 7 );
	for ($d = 1; $d <= $n; $d++){
		$txt = $d."-8";
		$sum_naloga=$sum_naloga+$record[$txt];
		if($d==$n){
			$pdf->MultiCell(181,4,$sum_naloga,0,'R',false,0,13,$y2);
		}
	}
	
	
    $pdf->Output( $name_pdf ,'I');
    return $name_pdf;
}

generate_schet_torg12();
?>

<p>hello!</p>
<a href="out/schet.pdf">Take PDF document!</a>
