<?php

use Spatie\PdfToText\Pdf;

require '../vendor/autoload.php';

if (isset($_POST['submit'])) {
  $text = Pdf::getText($_FILES['file']['tmp_name'], "C:\\tools\\xpdf-tool\\xpdf-tools-win-4.04\\bin64\\pdftotext.exe");

  $text = str_replace(PHP_EOL, ' ', $text);

  $detectEncode = mb_detect_encoding($text, 'UTF-8, ISO-8859-1, ISO-8859-15');

  $decodeString = mb_convert_encoding($text, 'UTF-8', $detectEncode);

  $search = 'A vida não é';

  if (preg_match_all("/$search/", $decodeString, $matches)) {
    dd($matches);
  } else {
    dd('not found');
  }
}

?>

<form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="file" id="file">
  <input type="submit" name="submit" value="Submit">
</form>