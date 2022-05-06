<?php
    function rrmdir($dir) { 
        if (is_dir($dir)) { 
            $objects = scandir($dir);
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                    rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                    else
                    unlink($dir. DIRECTORY_SEPARATOR .$object); 
                } 
            }
            rmdir($dir); 
        } 
    }

    function is_session_started()
    {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }

    function GetConversionRate($currency){
        $ConversionRates = array("LBP"=>26000);

        if($currency != "USD"){
            return $ConversionRates[$currency];
        }else {
            return 1;
        }
    }

?>