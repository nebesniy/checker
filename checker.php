<?php

// Проверка и установка настроек для отображения ошибок
// Checking and setting settings for displaying errors
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Проверка наличия и получение параметров url и word из GET-запроса
// Checking the presence and obtaining the url and word parameters from a GET request
$url = isset($_GET["url"]) ? urldecode($_GET["url"]) : null;
$word = isset($_GET["word"]) ? urldecode($_GET["word"]) : null;

// Проверка существования и валидности URL
// Checking the existence and validity of a URL
if (!$url || filter_var($url, FILTER_VALIDATE_URL) === false) {
    exit("URL не валиден / Invalid URL");
}

// Получение содержимого URL с помощью cURL
// Getting the content of a URL using cURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$content = curl_exec($curl);
curl_close($curl);

// Проверка наличия слова в содержимом
// Checking for a word in the content
if (strpos($content, $word) !== false) {
    echo "1";
} else {
    echo "0";
}
