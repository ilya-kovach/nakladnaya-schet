<html>
<head>
<title>Накладная</title>
<style type="text/css">
body {
	min-width:900px;
	margin:0;
}
textarea {
	width: 40%;
	resize: none;
} 
.style1 {
	font-family:"Comic Sans MS";
	font-size: 18px;
	line-height: 30%;
}
.style2 {
	font-family:"Comic Sans MS";
	font-size: 18px;
	line-height: 100%;
}
.style-table {
	font-family:"Comic Sans MS";
	font-size: 15px;
	line-height: 100%;
}
#layer1 { z-index: 1; }
#layer2 { z-index: 10; }
</style>
</head>
<body>

<form method="POST" action="nakl.php" style="margin-bottom:0px;">
	
	<div style="width: 100%; background: #EDE9DF; z-index: -1;">
	<p align="center" style='font-family:"Comic Sans MS"; height: 0px; font-size: 27px;'>Заполните поля накладной:</p><br>
	<div id="layer2"><table width="90%" style='margin-left: 5%;'>
		<tr>
			<td width="56%" class="style1">Название фирмы:</td>
			<td width="44%" class="style1">Грузополучатель:</td>
		</tr>
	</table></div>
	<p><textarea name="comment1" rows="3" style="margin-left: 5%; margin-top: 0px"></textarea>
	   <textarea name="comment2" rows="3" style="margin-left: 10%; margin-top: 0px"></textarea></p>
	<table width="90%" style='margin-left: 5%'>
		<tr>
			<td width="56%" class="style1">Поставщик:</td>
			<td width="44%" class="style1">Плательщик:</td>
		</tr>
	</table>
	<p><textarea name="comment3" rows="3" style="margin-left: 5%; margin-top: 0px"></textarea>
	   <textarea name="comment4" rows="3" style="margin-left: 10%; margin-top: 0px"></textarea></p>
	   
	<table style='margin-left: 5%'>
		<tr>
			<td width="145px" class="style2">  Дата создания:</td>
			<td width="200px"><input width="300px" type="text" name="data_sozdaniya"></td>
			<td width="160px" class="style2">  Номер документа:</td>
			<td width="200px"><input width="300px" type="text" name="nomer_dokгmenta"></td>
		</tr>
		<tr>
			<td width="145px" class="style2">  Форма по ОКУД:</td>
			<td width="200px"><input width="300px" type="text" name="OKUD"></td>			
			<td width="160px" class="style2">  ОКПО:</td>
			<td width="200px"><input width="300px" type="text" name="OKPO"></td>
		</tr>
	</table>	
	</div>
	
	<hr noshade size="3px" color="#A81F29" style="left: 10%; width: 80%; min-width: 720px;">
	
	<div style="margin-bottom: 8px;">
	<input type="button" onclick="add_string()" style="margin-left: 6.5%;" value="Добавить товар" name="dobavit_tovar">
	<input type="button" onclick="clean_string()" style="margin-left: 6.5%;" value="Убрать товар" name="ubrat_tovar">
	</div>
	
	<div style="min-height: 185px">
	<table table border="1" width="90%" align="center" id="tbl">
		<tr>
			<td width="6%"  align="center" rowspan="2" class="style-table">№</td>
			<td width="30%" align="center" rowspan="2" class="style-table">Товар (наименование, характеристика, сорт, арикул)</td>
			<td width="12%" align="center" colspan="2" class="style-table">Ед. изм.</td>
			<td width="12%" align="center" rowspan="2" class="style-table">Колличество</br>(масса нетто)</td>
			<td width="10%" align="center" rowspan="2" class="style-table">Цена</br>руб.коп.</td>
			<td width="10%" align="center" rowspan="2" class="style-table">Сумма без</br>учета НДС</td>
			<td width="10%" align="center" rowspan="2" class="style-table">Сумма с учетом НДС</td>
		</tr>
		<tr>
			<td align="center" class="style-table">Наи.</td>
			<td align="center" class="style-table">Код</td>
		</tr>
		<tr id="1">
			<td align="center" class="style-table">1</td>
			<td align="center" class="style-table"> <input id="1-1" style='width: 100%' type="text" name="tovar-1"> </td>
			<td align="center" class="style-table"> <input id="1-2" style='width: 100%' type="text" name="naimenovanie-1"> </td>
			<td align="center" class="style-table"> <input id="1-3" style='width: 100%' type="text" name="kod-1"> </td>
			<td align="center" class="style-table"> <input id="1-4" style='width: 100%' type="text" name="kolli4estvo-1"> </td>
			<td align="center" class="style-table"> <input id="1-5" style='width: 100%' type="text" name="cena-1"> </td>
			<td align="center" class="style-table"> <input id="1-6" style='width: 100%' type="text" name="bez_NDS-1"> </td>
			<td align="center" class="style-table"> <input id="1-7" style='width: 100%' type="text" name="s_NDS-1"> </td>
		</tr>
		<tr id="2">
			<td align="center" class="style-table">2</td>
			<td align="center" class="style-table"> <input id="2-1" style='width: 100%' type="text" name="tovar-2"> </td>
			<td align="center" class="style-table"> <input id="2-2" style='width: 100%' type="text" name="naimenovanie-2"> </td>
			<td align="center" class="style-table"> <input id="2-3" style='width: 100%' type="text" name="kod-2"> </td>
			<td align="center" class="style-table"> <input id="2-4" style='width: 100%' type="text" name="kolli4estvo-2"> </td>
			<td align="center" class="style-table"> <input id="2-5" style='width: 100%' type="text" name="cena-2"> </td>
			<td align="center" class="style-table"> <input id="2-6" style='width: 100%' type="text" name="bez_NDS-2"> </td>
			<td align="center" class="style-table"> <input id="2-7" style='width: 100%' type="text" name="s_NDS-2"> </td>
		</tr>
		<tr id="3">
			<td align="center" class="style-table">3</td>
			<td align="center" class="style-table"> <input id="3-1" style='width: 100%' type="text" name="tovar-3"> </td>
			<td align="center" class="style-table"> <input id="3-2" style='width: 100%' type="text" name="naimenovanie-3"> </td>
			<td align="center" class="style-table"> <input id="3-3" style='width: 100%' type="text" name="kod-3"> </td>
			<td align="center" class="style-table"> <input id="3-4" style='width: 100%' type="text" name="kolli4estvo-3"> </td>
			<td align="center" class="style-table"> <input id="3-5" style='width: 100%' type="text" name="cena-3"> </td>
			<td align="center" class="style-table"> <input id="3-6" style='width: 100%' type="text" name="bez_NDS-3"> </td>
			<td align="center" class="style-table"> <input id="3-7" style='width: 100%' type="text" name="s_NDS-3"> </td>
		</tr>
		<tr id="4">
			<td align="center" class="style-table">4</td>
			<td align="center" class="style-table"> <input id="4-1" style='width: 100%' type="text" name="tovar-4"> </td>
			<td align="center" class="style-table"> <input id="4-2" style='width: 100%' type="text" name="naimenovanie-4"> </td>
			<td align="center" class="style-table"> <input id="4-3" style='width: 100%' type="text" name="kod-4"> </td>
			<td align="center" class="style-table"> <input id="4-4" style='width: 100%' type="text" name="kolli4estvo-4"> </td>
			<td align="center" class="style-table"> <input id="4-5" style='width: 100%' type="text" name="cena-4"> </td>
			<td align="center" class="style-table"> <input id="4-6" style='width: 100%' type="text" name="bez_NDS-4"> </td>
			<td align="center" class="style-table"> <input id="4-7" style='width: 100%' type="text" name="s_NDS-4"> </td>
		</tr>
		<tr  id="5">
			<td align="center" class="style-table">5</td>
			<td align="center" class="style-table"> <input id="5-1" style='width: 100%' type="text" name="tovar-5"> </td>
			<td align="center" class="style-table"> <input id="5-2" style='width: 100%' type="text" name="naimenovanie-5"> </td>
			<td align="center" class="style-table"> <input id="5-3" style='width: 100%' type="text" name="kod-5"> </td>
			<td align="center" class="style-table"> <input id="5-4" style='width: 100%' type="text" name="kolli4estvo-5"> </td>
			<td align="center" class="style-table"> <input id="5-5" style='width: 100%' type="text" name="cena-5"> </td>
			<td align="center" class="style-table"> <input id="5-6" style='width: 100%' type="text" name="bez_NDS-5"> </td>
			<td align="center" class="style-table"> <input id="5-7" style='width: 100%' type="text" name="s_NDS-5"> </td>
		</tr>
	</table>
	</div>
	
	<hr noshade size="3px" color="#A81F29" style="left: 10%; width: 80%; min-width: 720px;">
	
	<div style="width: 100%; background: #A5897A; z-index: -1;  height: 175px">
	<table style="white-space:nowrap; margin-left: 5%; min-width: 612px;">
	<tr>
		<td width="145px" class="style2">  Отпуск разрешил</br>(должность):</td>
		<td width="150px"><input size="20px" type="text" name="otpusk_razreshil"></td>
		<td width="160px" class="style2">  Имя и инициалы:</td>
		<td width="150px"><input size="20px" type="text" name="name1"></td>
	</tr>
	<tr>
		<td width="145px" class="style2">  Главный(страший)</br>бугалтер:</td>
		<td width="150px"></td>			
		<td width="145px" class="style2" >  Имя и инициалы:</td>
		<td width="150px"><input size="20px" type="text" name="name2"></td>
	</tr>
		<tr>
		<td width="145px" class="style2">  Отпуск произвет</br>(должность):</td>
		<td width="150px"><input size="20px" type="text" name="otpusk_proisvel"></td>			
		<td width="145px" class="style2">  Имя и инициалы:</td>
		<td width="150px"><input size="20px" type="text" name="name3"></td>
	</tr>
	</table>	
	<input type="image" style="margin-left: 6.5%;" SRC="Untitled.png" name="okbutton">
	<input type="hidden" id="strrr" name="kolli4estvo_strok" value="5">
	</div>

	<script type="text/javascript">
	var str=5;
	
	function add_string() {
		var qq=document.getElementById("tbl");
		str = str + 1;
		document.getElementById("strrr").value = str;
		qq.innerHTML = dobavlenie();		
	}
	
	function dobavlenie(){
		var i = 1;
		var mm = document.getElementById("tbl").innerHTML;
		var mm = '<table table border="1" width="90%" align="center" id="tbl">'+'<tr><td width="6%"  align="center" rowspan="2" class="style-table">№</td><td width="30%" align="center" rowspan="2" class="style-table">Товар (наименование, характеристика, сорт, арикул)</td><td width="12%" align="center" colspan="2" class="style-table">Ед. изм.</td><td width="12%" align="center" rowspan="2" class="style-table">Колличество</br>(масса нетто)</td><td width="10%" align="center" rowspan="2" class="style-table">Цена</br>руб.коп.</td><td width="10%" align="center" rowspan="2" class="style-table">Сумма без</br>учета НДС</td><td width="10%" align="center" rowspan="2" class="style-table">Сумма с учетом НДС</td></tr><tr><td align="center" class="style-table">Наи.</td><td align="center" class="style-table">Код</td></tr>';
		while (i < str) {
		  mm += '<tr align="center" id="'+ i +'">' +
			'<td align="center" class="style-table">'+ i +'</td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-1" value="'+ document.getElementById(i + '-1').value +'" style="width: 100%" type="text" name="tovar-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-2" value="'+ document.getElementById(i + '-2').value +'" style="width: 100%" type="text" name="naimenovanie-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-3" value="'+ document.getElementById(i + '-3').value +'" style="width: 100%" type="text" name="kod-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-4" value="'+ document.getElementById(i + '-4').value +'" style="width: 100%" type="text" name="kolli4estvo-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-5" value="'+ document.getElementById(i + '-5').value +'" style="width: 100%" type="text" name="cena-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-6" value="'+ document.getElementById(i + '-6').value +'" style="width: 100%" type="text" name="bez_NDS-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-7" value="'+ document.getElementById(i + '-7').value +'" style="width: 100%" type="text" name="s_NDS-'+ i +'"> </td>'+
		  '</tr>';
		  i++;
		}
		mm += '<tr align="center" id="'+ i +'">' +
			'<td align="center" class="style-table">'+ i +'</td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-1" value="" style="width: 100%" type="text" name="tovar-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-2" value="" style="width: 100%" type="text" name="naimenovanie-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-3" value="" style="width: 100%" type="text" name="kod-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-4" value="" style="width: 100%" type="text" name="kolli4estvo-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-5" value="" style="width: 100%" type="text" name="cena-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-6" value="" style="width: 100%" type="text" name="bez_NDS-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-7" value="" style="width: 100%" type="text" name="s_NDS-'+ i +'"> </td>'+
		  '</tr>';
		mm += '</table>';
		return mm;
	}
	
	function clean_string() {
		var qq=document.getElementById("tbl");
		if (str > 1){
		str = str - 1;
		document.getElementById("strrr").value = str;
		qq.innerHTML = udalenie();
		}
	}
	
	function udalenie(){
		var i = 1;
		var mm = document.getElementById("tbl").innerHTML;
		var mm = '<table table border="1" width="90%" align="center" id="tbl">'+'<tr><td width="6%"  align="center" rowspan="2" class="style-table">№</td><td width="30%" align="center" rowspan="2" class="style-table">Товар (наименование, характеристика, сорт, арикул)</td><td width="12%" align="center" colspan="2" class="style-table">Ед. изм.</td><td width="12%" align="center" rowspan="2" class="style-table">Колличество</br>(масса нетто)</td><td width="10%" align="center" rowspan="2" class="style-table">Цена</br>руб.коп.</td><td width="10%" align="center" rowspan="2" class="style-table">Сумма без</br>учета НДС</td><td width="10%" align="center" rowspan="2" class="style-table">Сумма с учетом НДС</td></tr><tr><td align="center" class="style-table">Наи.</td><td align="center" class="style-table">Код</td></tr>';
		while (i <= str) {
		  mm += '<tr align="center" id="'+ i +'">' +
			'<td align="center" class="style-table">'+ i +'</td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-1" value="'+ document.getElementById(i + '-1').value +'" style="width: 100%" type="text" name="tovar-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-2" value="'+ document.getElementById(i + '-2').value +'" style="width: 100%" type="text" name="naimenovanie-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-3" value="'+ document.getElementById(i + '-3').value +'" style="width: 100%" type="text" name="kod-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-4" value="'+ document.getElementById(i + '-4').value +'" style="width: 100%" type="text" name="kolli4estvo-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-5" value="'+ document.getElementById(i + '-5').value +'" style="width: 100%" type="text" name="cena-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-6" value="'+ document.getElementById(i + '-6').value +'" style="width: 100%" type="text" name="bez_NDS-'+ i +'"> </td>'+
			'<td align="center" class="style-table"> <input id="'+ i +'-7" value="'+ document.getElementById(i + '-7').value +'" style="width: 100%" type="text" name="s_NDS-'+ i +'"> </td>'+
		  '</tr>';
		  i++;
		}
		mm += '</table>';
		return mm;
	}
	
	
	</script>
	

	
</form>
</body>
</html>
