<?php

if(!array_key_exists ("name", $_POST) || $_POST['name'] == NULL || $_POST['name'] == ''){

 $isempty = true;

} else {

 $html .= '<pre>';
 $html .= 'Hello ' . $_POST['name'];
 $html .= '</pre>';
}

?>
