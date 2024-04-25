<?php

// Проверка и установка настроек для отображения ошибок
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Проверка наличия и получение параметров url и word из GET-запроса
$url = isset($_GET["url"]) ? urldecode($_GET["url"]) : null;
$word = isset($_GET["word"]) ? urldecode($_GET["word"]) : null;

// Проверка существования и валидности URL
if (!$url || filter_var($url, FILTER_VALIDATE_URL) === false) {
    die("Not a valid URL");
}

// Создание экземпляра cURL
$curl = curl_init();

// Установка URL и других параметров
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'nebesniy/checker'); // Установка пользовательского агента

// Получение содержимого URL с помощью cURL
$content = curl_exec($curl);

// Проверка на ошибки
if ($content === false) {
    die("Error fetching URL: " . curl_error($curl));
}

// Закрытие cURL-соединения
curl_close($curl);

// Проверка наличия слова в содержимом
if (strpos($content, $word) !== false) {
    echo "1";
} else {
    echo "0";
}
