<?php
class Redirector
{
    public function __construct($location) {
        header("Location: {$location}");
        exit;
    }
}