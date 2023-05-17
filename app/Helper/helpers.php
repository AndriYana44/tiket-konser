<?php

if(!function_exists('currentRoute')) {
    function currentRoute(){
        return url()->current();    
    }
}