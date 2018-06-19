<?php
/*
baseado no trabalho de : 
FRED JORGE TAVARES DE LUCENA
BUSCA FONÉTICA EM PORTUGUÊS DO BRASIL
http://www.unibratec.com.br/jornadacientifica/diretorio/NOVOB.pdf

*/
function SoundexBR($word)
{
	$word = trim($word);

	// 1 - Transformar em maiúscula
	$word = strtoupper($word);

	// 2 - Eliminar todos os acentos das 'vogais'; 
	$utf8 = [
        '/[ÁÀÂÃÄ]/u'    => 'A',
        '/[áàâãªä]/u'   => 'a',
        // '/Ç/'           => 'C',
        // '/ç/'           => 'c',
        '/[ÉÈÊË]/u'     => 'E',
        '/[éèêë]/u'     => 'e',
        '/[ÍÌÎÏ]/u'     => 'I',
        '/[íìîï]/u'     => 'i',
        '/Ñ/'           => 'N',
        '/ñ/'           => 'n',
        '/[ÓÒÔÕÖ]/u'    => 'O',
        '/[óòôõºö]/u'   => 'o',
        '/[úùûü]/u'     => 'u',
        '/[ÚÙÛÜ]/u'     => 'U',
        '/Ý/'           => 'Y',
        '/[ýÿ]/u'       => 'y',
        "/['\"`´]/"     => '',
        '/[’‘‹›‚]/u'    => '',
		'/[“”«»„]/u'    => '',
		'/[\.]/u'       => '',
		'/–/'           => '',
        '/ª/'           => 'a.',
        '/º/'           => 'o.',
        '/°/'           => 'o.',
        // '/–/'           => '-', // UTF-8 hyphen to "normal" hyphen
        // '/[’‘‹›‚]/u'    => "'", // Literally a single quote
        // '/[“”«»„]/u'    => '"', // Double quote
        '/ /'           => ' ', // nonbreaking space (equiv. to 0x160)
    ];
	$word = preg_replace(array_keys($utf8), array_values($utf8), $word);
	
	// 3 - Substituição para evitar erros gerados na grafia das palavras
	$tabela_sub = [
		'/ç/' => 'S',
		'/Ç/' => 'S',
		'/BL|BR/' => 'B',
		'/PH/' => 'F',
		'/GL|GR|MG|NG|RG/' => 'G',
		'/Y/' => 'I',
		'/GE|GI|RJ|MJ/' => 'J',
		'/CA|CO|CU|CK|Q/' => 'K',
		'/N/' => 'M',
		'/AO|AUM|GM|MD|OM|ON/' => 'M',
		'/PR/' => 'P',
		'/L/' => 'R',
		'/CE|CI|CH|CS|RS|TS|X|Z/' => 'S',
		'/TR|TL/' => 'T',
		'/CT|RT|ST|PT/' => 'T',
		'/\b[UW]/' => 'V',
		'/RM/' => 'SM',
		'/[MRS]+\b/' => '',
		'/[AEIOUH]/' => '',
	];
	$word = preg_replace(array_keys($tabela_sub), array_values($tabela_sub), $word);
	return $word;
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
	<form action="soundexbr.php" method="get">
	<fieldset>
		<legend>Fonetica</legend>	
		<input name="text" type="text" autofocus>
		<br><br>
		<input name="" type="submit" value="Enviar">
		<input type="reset" value="Limpar">
	</form>
	</fieldset>	
</div>
</body>
</html>

<?php
/*
baseado no trabalho de : 
FRED JORGE TAVARES DE LUCENA
BUSCA FONÉTICA EM PORTUGUÊS DO BRASIL
http://www.unibratec.com.br/jornadacientifica/diretorio/NOVOB.pdf

*/
function SoundexBR($word)
{
	$word = trim($word);

	// 1 - Transformar em maiúscula
	$word = strtoupper($word);
	// echo $word;

	// 2 - Eliminar todos os acentos das 'vogais'; 
	$utf8 = [
        '/[ÁÀÂÃÄ]/u'    => 'A',
        '/[áàâãªä]/u'   => 'a',
        // '/Ç/'           => 'C',
        // '/ç/'           => 'c',
        '/[ÉÈÊË]/u'     => 'E',
        '/[éèêë]/u'     => 'e',
        '/[ÍÌÎÏ]/u'     => 'I',
        '/[íìîï]/u'     => 'i',
        // '/Ñ/'           => 'N',
        // '/ñ/'           => 'n',
        '/[ÓÒÔÕÖ]/u'    => 'O',
        '/[óòôõºö]/u'   => 'o',
        '/[úùûü]/u'     => 'u',
        '/[ÚÙÛÜ]/u'     => 'U',
        // '/Ý/'           => 'Y',
        // '/[ýÿ]/u'       => 'y',
        "/['\"`´]/"     => '',
        '/[’‘‹›‚]/u'    => '',
		'/[“”«»„]/u'    => '',
		'/[\.]/u'       => '',
		'/–/'           => '',
        '/ª/'           => 'a.',
        '/º/'           => 'o.',
        '/°/'           => 'o.',
        // '/–/'           => '-', // UTF-8 hyphen to "normal" hyphen
        // '/[’‘‹›‚]/u'    => "'", // Literally a single quote
        // '/[“”«»„]/u'    => '"', // Double quote
        '/ /'           => ' ', // nonbreaking space (equiv. to 0x160)
    ];
	$word = preg_replace(array_keys($utf8), array_values($utf8), $word);
	
	// 3 - Substituição para evitar erros gerados na grafia das palavras
	$tabela_sub = [
		'/ç/' => 'S',
		'/Ç/' => 'S',
		'/BL|BR/' => 'B',
		'/PH/' => 'F',
		'/GL|GR|MG|NG|RG/' => 'G',
		'/Y/' => 'I',
		'/GE|GI|RJ|MJ/' => 'J',
		'/CA|CO|CU|CK|Q/' => 'K',
		'/N/' => 'M',
		'/AO|AUM|GM|MD|OM|ON/' => 'M',
		'/PR/' => 'P',
		'/L/' => 'R',
		'/CE|CI|CH|CS|RS|TS|X|Z/' => 'S',
		'/TR|TL/' => 'T',
		'/CT|RT|ST|PT/' => 'T',
		'/\b[UW]/' => 'V',
		'/RM/' => 'SM',
		'/[MRS]+\b/' => '',
		'/[AEIOUH]/' => '',
	];
	$word = preg_replace(array_keys($tabela_sub), array_values($tabela_sub), $word);
	return $word;
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
	<form action="soundexbr.php" method="get">
	<fieldset>
		<legend>Fonetica</legend>	
		<input name="text" type="text" autofocus>
		<br><br>
		<input name="" type="submit" value="Enviar">
		<input type="reset" value="Limpar">
	</form>
	</fieldset>	
</div>
</body>
</html>

