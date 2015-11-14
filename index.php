<?php



?><html>
<head>
<meta charset="utf=8" />

<title>Kalkulator</title>


<style type="text/css">

#calc .wyswietlacz{
	width:500px;
	text-align:right;
	margin-bottom:10px;
}
#calc .przycisk{
	width:113px;
	margin:5px;
}

form{
	margin:auto;
}

</style>
<script>

var wyswietlacz = {

	pobierz:function() {
		var x = document.getElementById('wyswietlacz').value;
		return x;
	},
	zapamietaj:function() {
		var x = document.getElementById('wyswietlacz').value;
		var history = document.getElementById('history');
		history.value = history.value + x;		
		history.scrollTop = history.scrollHeight;
		return x;
	},
	wyczysc:function() {
		this.zapamietaj();	
		document.getElementById('wyswietlacz').value = '';
	},
	nl:function() {
		var history = document.getElementById('history');
		history.value = history.value + "\n";		
		history.scrollTop = history.scrollHeight;
	},	
	dopisz:function(znak) {
		var x = document.getElementById('wyswietlacz').value;
		document.getElementById('wyswietlacz').value = x + znak;
	}

	
}; 

var mem = 0;
var funkcja =  false; //function(x){return x;};
function dodaj(x){
	return Number(mem) + Number(x);
}
function odejmij(x){
	return Number(mem) - Number(x);
}
function mnozenie(x){
	return Number(mem) * Number(x);
}
function dzielenie(x){
	return Number(mem) / Number(x);
}

function oblicz(x){	
	return funkcja(x);
}

var lcd = wyswietlacz;


function klik(p){

	 if (isNaN(p)) {
		var wynik = 0;
		var x = lcd.pobierz();
			
			if(p!=''){
				lcd.wyczysc(); 
				lcd.dopisz(p); 
				if(p=='='){
					var wynik = oblicz(x);
					if(wynik==Infinity){
						alert('Dzielenie przez zero!');
						wynik = 0;
					}
					mem = wynik;
					lcd.wyczysc();
					lcd.dopisz(wynik);
					lcd.wyczysc();
					lcd.nl();
					
				}				
				if(p!='='){
					mem = x;
				}	
				if(p=='+'){
					funkcja = dodaj;		
				}
				if(p=='-'){
					funkcja = odejmij;		
				}				
				if(p=='*'){
					funkcja = mnozenie;		
				}
				if(p=='/'){
					funkcja = dzielenie;		
				}												
				lcd.wyczysc();
			}
		
	}else{
		lcd.dopisz(p); 
	}     


}

</script>
</head>
<body>

<form id="calc">
<textarea id="history" class="wyswietlacz" rows="8"></textarea> <br />

<input id="wyswietlacz" class="wyswietlacz" type="text" value="" /> <br />
<?php 
$przyciski = array(
	7,8,9,'+',
	4,5,6,'-',
	1,2,3,'*',
	0,'/','.','=');
foreach($przyciski as $k => $v)
{
	echo '<input type="button" class="przycisk" value="'.$v.'" onclick="klik(\''.$v.'\')" />'.PHP_EOL;
	if(( ($k+1)%4 ) === 0 ) echo '<br />'.PHP_EOL;
}
?>

</form>


</body>
