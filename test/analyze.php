<?php
require dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
array_shift($argv);

## Text creation
$text = "";
if (isset($argv[0]) && $argv[0] == '-f')
{
    array_shift($argv);
    foreach ($argv as $arg)
        $text .= file_get_contents($arg).PHP_EOL;
}
else
{
    $text = implode(" ", $argv);
}
## Analyzing
$analyzer = new wapmorgan\TextEmotions\EnTextEmotions($text);
$analyzer->analyze();
echo "Metric: positivity (".$analyzer->getPositivityMetric().") [".str_repeat("+", $analyzer->getPositivityMetric()).
    str_repeat("-", $analyzer->getNegativityMetric())."] negativity (".$analyzer->getNegativityMetric().")".PHP_EOL;
echo "Scrore: positivity: ".$analyzer->getPositivityScore()." / negativity: ".$analyzer->getNegativityScore().PHP_EOL;

foreach ($analyzer->getFeelings()->iterator() as $feeling => $score) {
    echo $feeling.": (".$score.")".PHP_EOL;
}