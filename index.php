<?php
header('Content-Type: text/html; charset=utf-8');

$host = '';
if (!empty($_POST['host']))
{
	$host = $_POST['host'];
} elseif (!empty($_GET['host']))
{
	$host = $_GET['host'];
}

//form for get URL
echo '
	<form method="POST">
		URL: <input type="text" name="host" value="' . $host . '" size="50">
		<br />
		<input type="submit" value="Parse">
	</form>';


if ($host)
{
	//if host posted, parsing content
	
	include('simple_html_dom.php');

	// Create DOM from URL or file
	$html = file_get_html($host);
	
	//get the body plain text
	$body = $html->plaintext;

	//replace all punctuation
	$body = preg_replace('/[[:punct:]]+/', ' ', $body);

	//explode words to array without empty words
	$words = array_filter(explode(' ', $body));

	//filter all words contain 'gy' (non case-sensitive)
	//$containtStr = 'gy';
	$words = array_filter($words, function ($var) { return (stripos($var, 'gy') !== false); } );

	foreach ($words as $word)
	{
		echo $word;
		echo '<br />';
	}
	
}
