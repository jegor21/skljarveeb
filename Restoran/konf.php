<?php
$kasutaja="d124970_oleksiibaas";
$parool="Gugelnator3333$";
$andmebaas="d124970_oleksiibaaas";
$serverinimi="d124970.mysql.zonevs.eu";

$yhendus=new mysqli($serverinimi,$kasutaja,$parool,$andmebaas);
$yhendus->set_charset("UTF8");  //PHP lõpumärki pole vaja, et kogemata midagi välja ei trükitaks

