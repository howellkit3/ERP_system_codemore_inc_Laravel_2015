<?php 
header("Content-type: application/pdf"); 
echo $this->Html->css('word.css');
echo $content_for_layout; 
?>