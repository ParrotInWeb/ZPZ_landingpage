<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$companyName        = (isset($_POST['companyName'])     && !empty($_POST['companyName']))       ? $_POST['companyName']     : '' ;
$nameAndSurname     = (isset($_POST['nameAndSurname'])  && !empty($_POST['nameAndSurname']))    ? $_POST['nameAndSurname']  : '' ;
$addressEmail       = (isset($_POST['addressEmail'])    && !empty($_POST['addressEmail']))      ? (filter_var($_POST['addressEmail'], FILTER_VALIDATE_EMAIL) ? $_POST['addressEmail'] : '') : '' ;
$productName        = (isset($_POST['productName'])     && !empty($_POST['productName']))       ? $_POST['productName']     : '' ;
$productUrl         = (isset($_POST['productUrl'])      && !empty($_POST['productUrl']))        ? $_POST['productUrl']      : '' ;
$procuctDescribe    = (isset($_POST['procuctDescribe']) && !empty($_POST['procuctDescribe']))   ? $_POST['procuctDescribe'] : '' ;
$checkRodo          = (isset($_POST['checkRodo'])       && !empty($_POST['checkRodo']))         ? $_POST['checkRodo']       : '' ;


$to      = 'biuro@zpasjizrobione.pl';
$subject = 'Landing Page: Zgłoszenie produktu';
$message = 'Witaj!<br>'
        . '<br>'
        . 'Otrzymałeś wiadomość od <strong>' . $nameAndSurname . '</strong> z adresu mailowego <a href="mailto:' . $addressEmail . '"> ' . $addressEmail . '</a><br>'
        . '<br>'
        . 'Użytkownik przesyła Ci informacje na temat produktu <strong>' . $productName . '</strong><br>'
        . 'Produkt dostępny jest na stronie: <a href="' . $productUrl . '">' . $productUrl . '</a><br>'
        . '<br>'
        . 'Opis produktu:<br>'
        . $procuctDescribe
        . '<br><br>'
        . 'użytkownik <strong>' . (($checkRodo == "on") ? '' : 'NIE') . 'wyraził zgod' . (($checkRodo == "on") ? 'ę' : 'y') . '</strong> na przetwarzanie danych osobowych.'
        . '<br><br>'
        . 'Wiadomość wygenerowana na podstawie formularza z strony ... wypełnionego w dniu ' . date("Y-m-d H:i:s");

$headers = 'From: ' . $addressEmail . "\r\n" .
    'Reply-To: ' . $addressEmail . "\r\n" .
    'Content-Type: text/html; charset=UTF-8' .  
    'X-Mailer: PHP/' . phpversion();

if ($nameAndSurname != '' && $addressEmail != '' && $productName != '' && $procuctDescribe != '' && $checkRodo != '') {
    
    $success = mail($to, $subject, $message, $headers);

    if ($success) {
        # Set a 200 (okay) response code.
        http_response_code(200);
        echo "Dziękujemy! Twoja wiadomość została wysłana!";
    } else {
        # Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Nie mogliśmy wysłać wiadomości. Sprawdź wypełnienie formularza lub spróbuj później.";
    }
}
else {
        http_response_code(500);
        echo "Nie mogliśmy wysłać wiadomości. Sprawdź wypełnienie formularza lub spróbuj później.";
}