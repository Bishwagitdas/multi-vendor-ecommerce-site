<?php

/**
 * Pre Tag Helper
 */

 if(!function_exists('pre'))
 {
    function pre($values)
    {
        echo "<pre>";
        print_r($values);
        echo "</pre>";
    }
 }

/**
 * Date Formate Helper
 */
