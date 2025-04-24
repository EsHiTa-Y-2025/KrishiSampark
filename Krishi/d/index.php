<?php
require 'vendor/autoload.php';
ini_set("display_errors", 1);
use Google\Cloud\Translate\V2\TranslateClient;

$translate = new TranslateClient([
    'key' => 'AIzaSyAfHSB1goBp7l9uRaZ8PXPN2n35B4-pbZw', // Use the API key you generated
]);

// Text to translate
$text = 'Hello, world!';

// Target language code (e.g., 'es' for Spanish)
$targetLanguage = 'es';

// Translate the text
$translation = $translate->translate($text, ['target' => $targetLanguage]);

// Output the translated text
echo "Original: $text\n";
echo "Translation: " . $translation['text'] . "\n";

?>