<?php
// controllers/HomeController.php

class HomeController {
    public function index() {
        include($_SERVER['DOCUMENT_ROOT'] . '/src/Views/home.php');
        
    }
}
?>
