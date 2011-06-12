<?php
/**
 * Compilation of system-wide functions
 */

/**
 * Checks if there is a duplicate in an array
 * @param array $array
 * @return bool 
 */
function hasDuplicate($array){
    return (count($array)==count(array_unique($array))) ? false:true;
}

/**
 * Creates an array of numbers
 * @param int $min
 * @param int $max
 * @return array 
 */
function makeNumArray($min,$max,$order='ASC'){
    $order = strtoupper($order);
    $arrayOptions = array();    
    for ($x = $min; $x <= $max; $x++)
        $arrayOptions[$x] = $x;
    if($order=='DESC')
        $arrayOptions = array_reverse ($arrayOptions, true);
    return $arrayOptions;
}

/**
 * genRandomString - Generates random string
 * @param int $length Length of the return string.
 * @param string $chars User-defined set of characters to be used in randoming. If this is set, $type will be ignored.
 * @param array $type Type of the string to be randomed.Can be set by boolean values.
 * <ul>
 * <li><b>alphaSmall</b> - small letters, true by default</li>
 * <li><b>alphaBig</b> - big letters, true by default</li>
 * <li><b>num</b> - numbers, true by default</li>
 * <li><b>othr</b> - non-alphanumeric characters found on regular keyboard, false by default</li>
 * <li><b>duplicate</b> - allow duplicate use of characters, true by default</li>
 * </ul>
 * @return string The generated random string
 */
function genRandomString($length=10, $chars='', $type=array()) {
    //initialize the characters
    $alphaSmall = 'abcdefghijklmnopqrstuvwxyz';
    $alphaBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '0123456789';
    $othr = '`~!@#$%^&*()/*-+_=[{}]|;:",<>.\/?' . "'";

    $characters = "";
    $string = '';  
    //defaults the array values if not set
    isset($type['alphaSmall'])  ? $type['alphaSmall']: $type['alphaSmall'] = true;  //alphaSmall - default true  
    isset($type['alphaBig'])    ? $type['alphaBig']: $type['alphaBig'] = true;      //alphaBig - default true
    isset($type['num'])         ? $type['num']: $type['num'] = true;                //num - default true
    isset($type['othr'])        ? $type['othr']: $type['othr'] = false;             //othr - default false 
    isset($type['duplicate'])   ? $type['duplicate']: $type['duplicate'] = true;    //duplicate - default true     
    
    if (strlen(trim($chars)) == 0) { 
        $type['alphaSmall'] ? $characters .= $alphaSmall : $characters = $characters;
        $type['alphaBig'] ? $characters .= $alphaBig : $characters = $characters;
        $type['num'] ? $characters .= $num : $characters = $characters;
        $type['othr'] ? $characters .= $othr : $characters = $characters;        
    }
    else
        $characters = str_replace(' ', '', $chars);
      
    if($type['duplicate'])
        for (; $length > 0 && strlen($characters) > 0; $length--) {
            $ctr = mt_rand(0, (strlen($characters)) - 1);
            $string .= $characters[$ctr];
        }
    else
        $string = substr (str_shuffle($characters), 0, $length);
   
    return $string;
}

/**
 * Hashes the password for comparison to the db
 * @param string $password
 * @param string $salt
 * @return string 
 */
function passwordHasher($password,$salt=''){
    return md5($password.crypt($password,'$2A$'. SALT_GLOBAL.$salt.'$'));
}
?>
