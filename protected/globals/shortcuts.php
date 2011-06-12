<?php
/**
 * Compilation of Yii shortcuts 
 */

function app(){
    return Yii::app();
}

function addJS($name,$script){
	app()->clientScript->registerScript($name,$script);
}
?>
