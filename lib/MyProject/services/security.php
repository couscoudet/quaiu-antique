<?php

function secure(string $str) {
    return htmlspecialchars($str, ENT_QUOTES);
}

function checkIfDate(string $date) {
    if (preg_match("/^(\d{4}[-\/]\d{2}[-\/]\d{2}|\d{2}[-\/]\d{2}[-\/]\d{4})$/", $date)) {
        return true;
    } else {
        throw new RuntimeException('Le format de date n\'est pas valide');
    } 
}

function checkNumber(int $num) {
    if (is_numeric($num) && ($num) > 0 && ($num) < 500) {
        return true;
    } else {
        throw new RuntimeException('Le format numérique n\'est pas valide');
    } 
}

function checkIfMail(str $mail){
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return $mail;
    } 
    else {
        throw new RunTimeException('Il y\'a un problème avec le format d\'email');
    }
}

function checkIfAdmin() {
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') 
    {
        return true;
    }
    else {
        throw new RunTimeException('Vous n\'avez pas les droits d\'accès à cette fonction');
    }
}