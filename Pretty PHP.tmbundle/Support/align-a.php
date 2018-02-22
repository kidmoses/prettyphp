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
 * @package PrettyPHP - Align Assignments
 */

//$content = file_get_contents('php://stdin');

$content = file_get_contents($_SERVER['argv'][2]);

$isn = substr($content, -1) == "\n" ? TRUE : FALSE;

$maxpos = 0;
$isa = 0;
$ars = array(".=","+=","-=","*=","/=","%="); 
$arb = array(">", "<", "=", "!");

$lines = explode("\n", $content); 
foreach ($lines as $index => $line) { 
  foreach($ars as $ar) {
    $pos = strpos($line,$ar);
    if($pos !== FALSE) {
      $isa = 2;
      $pos = strlen(rtrim($line,0,$pos));
      break;
    }
  }
  if($pos === FALSE) {
    $pos = strpos($line,"=");
    if($pos !== FALSE && !in_array($arb,$line[$pos-1]) && !in_array($arb,$line[$pos+1])) {
      $isa = $isa == 2 ? 2 : 1;
      $pos = strlen(rtrim(substr($line,0,$pos)));
    }
  }
  $maxpos = $pos > $maxpos ? $pos : $maxpos;
}

$maxpos++; // bump up $maxpos to add space before assignment
$tContent = "";
$lines = explode("\n", $content);
foreach ($lines as $index => $line) {
  $ptc = 0;
  if($isa) {
    foreach($ars as $ar) {
      $pos = strpos($line,$ar);
      if($pos !== FALSE) {
        $ptc = 2;
        break;
      }
    }
    if($pos === FALSE) {
      $pos = strpos($line,"=");
      if($pos !== FALSE) {
        $ptc = 1;
      }
    }
    if($pos !== FALSE) {
      if($line[$pos + $ptc] != " ") {
        $line = substr_replace($line, " ", $pos + $ptc, 0);
      }
      $xp = ($isa == 2 && $ptc == 1) ? 1 : 0;
      $line = str_pad(rtrim(substr($line,0,$pos)),$maxpos + $xp) . substr($line,$pos);
    }
  }
  $tContent .= $line . "\n";
}

echo rtrim($tContent);
if ($isn) { echo "\n"; }  // fix for how text was selected

?>
