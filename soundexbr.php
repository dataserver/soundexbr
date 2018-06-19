<?php
/*
baseado no trabalho de : 
FRED JORGE TAVARES DE LUCENA
BUSCA FONÉTICA EM PORTUGUÊS DO BRASIL
http://www.unibratec.com.br/jornadacientifica/diretorio/NOVOB.pdf

charset = UTF-8

*/
function SoundexBR($word, $enc = 'UTF-8')
{

	$text = trim($word);
	$accents = array(
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
	);
	$text = preg_replace($accents, array_keys($accents), htmlentities($text, ENT_NOQUOTES, $enc));
	$text = strtoupper($text);
	$arr = array(
		'I' => '/Y/',
		'B' => '/BR|BL/',
		'F' => '/PH/',
		'G' => '/GR|GL|MG|NG|RG/',
		'J' => '/GE|GI|RJ|MJ|NJ|RJ/',
		'K' => '/Q|CA|CO|CU|C|CK/',
		'L' => '/LH/',
		'M' => '/N|RM|GM|MD|SM/'
	);
	$text = preg_replace($arr, array_keys($arr), htmlentities($text, ENT_NOQUOTES, $enc));
	if (substr(text, -2)=='AO')
	{
		$text = substr(text, 0, -2) . 'M';
	}
	$arr = array(
		'N' => '/NH/',
		'P' => '/PR/',
//		'S' => '/Ç|CH|X|TS|C|Z|RS|CE|CI/',
		'S' => '/Ç|X|TS|C|Z|RS/',
		'T' => '/LT|TR|CT|RT|ST|TL/',
		'V' => '/W/'
	);
	$text = preg_replace($arr, array_keys($arr), htmlentities($text, ENT_NOQUOTES, $enc));
	$r = substr($text, -1);
	if($r=='S' || $r=='Z' || $r=='R' || $r=='M' || $r=='N' || $r=='L' || (substr($text, -2) == 'AO'))
	{
		if(substr(text, -2) == 'AO')
		{
			$text = substr($text, 0, -2);
		}
		else
		{
			$text = substr($text, 0, -1);
		}		
	}
	$text = str_replace('R','L', $text);
	$search = array('A','E','I','O','U','H');
	$replace = array('');
	$text = str_replace($search, $replace, $text);
	$text = preg_replace('{( ?.)\1{2,}}','$1',$text);
	return $text;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SoundexBR</title>
</head>
<body>

<?php

if (isset($_GET['text']))
{
	$text = $_GET['text'];
		
	print "Texto: ".$text."<BR>";
	
	print "Resultado: ";
	$arr = explode(' ', trim($text));
	for($i=0, $y=sizeof($arr); $i<$y; $i++)
	{
		if (strlen($arr[$i])>3)
		{
			print soundexbr($arr[$i]).' ';
			//soundexbr($arr[$i]).' ';
		}
	}
}

	//$text = 'KBBBSKKKK';
	//echo preg_replace('{( ?.)\1{2,}}','$1$1',$text);
?>
<div align="center">
	<fieldset><legend>Fonetica</legend>	
	<form action="soundexbr2.php" method="get" name="phone">
		<input name="text" type="text">
	<br><br>
	<input name="" type="submit" value="Enviar">
	<input type="reset" value="Limpar">
	</form>
	</fieldset>	
</div>
</body>
</html>

