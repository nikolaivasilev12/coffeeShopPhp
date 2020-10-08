<?php
class Redirector
{
    public function __construct($location) {
        $trimmed = str_replace('.php', '', $location) ;
        header("Location: {$trimmed}");
        exit();
    }
}