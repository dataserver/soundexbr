<?php
/*
baseado no trabalho de : 
FRED JORGE TAVARES DE LUCENA
BUSCA FONÉTICA EM PORTUGUÊS DO BRASIL
http://www.unibratec.com.br/jornadacientifica/diretorio/NOVOB.pdf

*/
function SoundexBR($word, $enc = 'UTF-8')
{
	$text = trim($word);
	$accents = [
		'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
		'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
		'C' => '/&Ccedil;/',
		'c' => '/&ccedil;/',
		'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
		'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
		'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
		'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
		'N' => '/&Ntilde;/',
		'n' => '/&ntilde;/',
		'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
		'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
		'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
		'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
		'Y' => '/&Yacute;/',
		'y' => '/&yacute;|&yuml;/',
		'a.' => '/&ordf;/',
		'o.' => '/&ordm;/'
	];
	$text = preg_replace($accents, array_keys($accents), htmlentities($text, ENT_NOQUOTES, $enc));
	$text = strtoupper($text);
	$arr = [
		'I' => '/Y/',
		'B' => '/BR|BL/',
		'F' => '/PH/',
		'G' => '/GR|GL|MG|NG|RG/',
		'J' => '/GE|GI|RJ|MJ|NJ|RJ/',
		'K' => '/Q|CA|CO|CU|C|CK/',
		'L' => '/LH/',
		'M' => '/N|RM|GM|MD|SM/'
	];
	$text = preg_replace($arr, array_keys($arr), htmlentities($text, ENT_NOQUOTES, $enc));
	if (substr($text, -2) == 'AO') {
		$text = substr(text, 0, -2) . 'M';
	}
	$arr = [
		'N' => '/NH/',
		'P' => '/PR/',
//		'S' => '/Ç|CH|X|TS|C|Z|RS|CE|CI/',
		'S' => '/Ç|X|TS|C|Z|RS/',
		'T' => '/LT|TR|CT|RT|ST|TL/',
		'V' => '/W/'
	];
	$text = preg_replace($arr, array_keys($arr), htmlentities($text, ENT_NOQUOTES, $enc));
	$r = substr($text, -1);
	if ($r == 'S' || $r == 'Z' || $r == 'R' || $r == 'M' || $r == 'N' || $r == 'L' || (substr($text, -2) == 'AO')) {
		$text = (substr($text, -2) == 'AO') ? substr($text, 0, -2):  substr($text, 0, -1);
	}
	$text = str_replace('R','L', $text);
	$search = ['A','E','I','O','U','H'];
	$replace = [''];
	$text = str_replace($search, $replace, $text);
	$text = preg_replace('{( ?.)\1{2,}}', '$1', $text);
	return $text;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SoundexBR</title>
</head>
<body>
<pre>
<?php
if (isset($_GET['text'])) {
	$text = $_GET['text'];
		
	echo "Origianal Texto: ". $text ."<br>";
	echo "SoundexBR: ";
	$arr = explode(' ', trim($text));
	for($i=0, $y=sizeof($arr); $i < $y; $i++) {
		if (strlen($arr[$i]) > 3) {
			echo soundexbr($arr[$i]).' ';
		}
	}
}
?>
</pre>
<div align="center">
	<form action="soundexbr.php" method="get" name="phone">
	<fieldset>
		<legend>Fonetica</legend>	
		<input name="text" type="text">
		<br><br>
		<input name="" type="submit" value="Enviar">
		<input type="reset" value="Limpar">
	</form>
	</fieldset>	
</div>
</body>
</html>

