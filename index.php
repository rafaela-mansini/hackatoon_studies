<?php
include('vendor/autoload.php');
use NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;

$text = "I'd like to a romantic night to enjoy my anniversary";
$text = "I want a romantic and special night to comemore my wedding anniversary";

$occasionKeywords = ["anniversary", "wedding", "birthday"];
$themeKeywords = ["romantic", "expensive", "excited", "happy"];


$filters = [
    'occasions' => [
        'birthday' =>['birthday', 'congratulations'],
        'anniversary' => ['anniversary', 'congratulations', 'wedding'],
        'retirement' => ['retirement'],
        'congratulations' => ['congratulations'],
        'farewell' => ['farewell'],
        'thank_you' => ['thank you'],
        'graduation' => ['graduation'],
        'housewarming' => ['housewarming'],
        'wedding' => ['wedding'],
        'new_born' => ['new bord'],
        'best_man_and_maid_of_honor' => ['best man', 'maid of honor']
    ],
    'theme' => [
        'romantic' => ['romantic', 'special', 'amazing'],
        'luxury' => ['luxury', 'amazing'],
    ],
];

$tok = new WhitespaceAndPunctuationTokenizer();
$tokens = $tok->tokenize($text);

$occasions = [];
$themes = [];

foreach ($tokens as $word) {
    $lowercaseWord = strtolower($word);

    if (in_array($lowercaseWord, $occasionKeywords)) {
        $occasions[] = $lowercaseWord;
    }

    if (in_array($lowercaseWord, $themeKeywords)) {
        $themes[] = $lowercaseWord;
    }
}



foreach ($filters as $filterName => $subFilters) {
    foreach ($subFilters as $subFilterName => $subFilterKeywords) {
        // Check if any of the sub-filter keywords are present in the user input
        $foundKeywords = array_intersect($subFilterKeywords, $tokens);

        // If keywords are found, add the sub-filter to the selectedFilters array
        if (!empty($foundKeywords)) {
            $selectedFilters[] = "$filterName=$subFilterName";
        }
    }
}

print_r($tok->tokenize($text));
print_r($occasions);
print_r($themes);
print_r($selectedFilters);