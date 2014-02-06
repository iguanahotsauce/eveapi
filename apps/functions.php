<?php

function template($context, $filepath) {
	foreach($context as $key => $variable) {
		$$key = $variable;
	}
	include($filepath);
}

function dump($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}