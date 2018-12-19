<?php
if(preg_match('~(bot|crawl)~i', $_SERVER['HTTP_USER_AGENT']))
{
 //Botsa yapılacaklar.
}
else
{
 //Bot değilse yapılacaklar.
}
?>
