#!/usr/bin/env php
<?php
/*
 * PrettyPHP
 *
 * See README for more information.
 *
 * VERSION created for Textmate 2
 *
 * PHP version &gt;= 5.0
 *
 * @copyright 2018 to present, Howard Walsh
 * @license   The MIT License (MIT)
 *
 * Copyright (c) 2018 Howard Walsh
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this 
 * software and associated documentation files (the "Software"), to deal in the Software 
 * without restriction, including without limitation the rights to use, copy, modify, merge, 
 * publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons 
 * to whom the Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies 
 * or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING 
 * BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND 
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, 
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @version 1.06 (2018-02-22)
 * @author  Howard Walsh &lt;prettyphp@kidmoses.com&gt;
 * @package PrettyPHP - Align Comments
 */

//$content = file_get_contents('php://stdin');

$content = file_get_contents($_SERVER['argv'][2]);

$isn = substr($content, -1) == "\n" ? TRUE : FALSE;

$maxpos = 0;
$isa = 0;
$ars = array("/*", "//", "#");

$lines = explode("\n", $content);
foreach ($lines as $index => $line) {
  foreach($ars as $ar) {
    $pos = strpos($line,$ar);
    if($pos !== FALSE && !inQuotes($line,$pos)) {
      $isa = 1;
      $pos = strlen(rtrim(substr($line,0,$pos)));
      break;
    }
  }
  $maxpos = $pos > $maxpos ? $pos : $maxpos;
}

$maxpos += 4;  // bump up $maxpos to add spaces before assignment
$tContent = "";
$lines = explode("\n", $content);
foreach ($lines as $index => $line) {
  $ptc = 0;
  if($isa) {
    foreach($ars as $ar) {
      $pos = strpos($line,$ar);
      if($pos !== FALSE && !inQuotes($line,$pos)) {
        if($ar == "#") {
          $line = substr($line,0,$pos+1) . "  " . trim(substr($line,$pos+1));
        } else {
          $line = substr($line,0,$pos+2) . " " . trim(substr($line,$pos+2));
        }
        break;
      }
    }
    $line = str_pad(rtrim(substr($line,0,$pos)),$maxpos) . substr($line,$pos);

  }
  $tContent .= $line . "\n";
}

echo rtrim($tContent);
if ($isn) { echo "\n"; }  // fix for how text was selected

/* helper function */
/* check if certain position in string ($ptc) is inside quotes */
function inQuotes($line, $ptc) {
  $isQuote = FALSE;
  for ($i = 0; $i < strlen($line); $i++){
    if($line[$i] == "'" && !$isQuote) {
      if($ptc < $i) { return FALSE; }
      $isQuote = TRUE;
      continue;
    }
    if($line[$i] == "'" && $isQuote) {
      if($ptc < $i) { return TRUE; }
      $isQuote = FALSE;
    }
  }

  $isQuote = FALSE;
  for ($i = 0; $i < strlen($line); $i++){
    if($line[$i] == '"' && !$isQuote) {
      if($ptc < $i) { return FALSE; }
      $isQuote = TRUE;
      continue;
    }
    if($line[$i] == '"' && $isQuote) {
      if($ptc < $i) { return TRUE; }
      $isQuote = FALSE;
    }
  }
  return FALSE;
}
?>
