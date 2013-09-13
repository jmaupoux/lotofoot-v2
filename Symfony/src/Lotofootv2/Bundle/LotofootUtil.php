<?php

namespace Lotofootv2\Bundle;

Class LotofootUtil {
    public static function validScore($score) {
        return 
        	preg_match('/^[0-9]+[-][0-9]+$/', 
        		preg_replace('/\s+/','',$score)
        	);
    }    
    
	public static function validResult($result) {
        return 
        	preg_match('/(1|N|2)$/', 
        		preg_replace('/\s+/','',$result)
        	);
    }
    
	public static function clearSpaces($str) {
        return 
        	preg_replace('/\s+/','',$str)
        ;
    }

}