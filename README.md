TextEmotions is a concept of text emotions analyzer written in PHP.

It parses text and finds out text mood by searching for emotions indicators (words).

## List of available metrics
1. Positivity score (number of word used in text).
    ```php
    $positivty_score = $analyzer->getPositivityScore();
    ```

2. Negativity score (number of word used in text).
    ```php
    $negativity_score = $analyzer->getNegativityScore();
    ```

    *Relying on scores, we can calculate general mood of text.*

3. Positivity percentage.
    ```php
    $positivity_metric = $analyzer->getPositivityMetric(); // returns a number from 0 to 100
    ```

4. Negativity percentage.
    ```php
    $negativity_metric = $analyzer->getNegativityMetric(); // returns a number from 0 to 100
    ```

    *Relying on percentage, we also can calculate general mood of text.*

5. Feelings scores. Feelings are fear, anger, sadness, joy, disgust, trust, anticipation, surprise.

    a. Fear score.
    ```php
    $feelings = $analyzer->getFeelings();
    $fear_score = $feelings->getFearScore();
    ```

    b. Anger score.
    ```php
    $feelings = $analyzer->getFeelings();
    $anger_score = $feelings->getAngerScore();
    ```

    c. Sadness score.
    ```php
    $feelings = $analyzer->getFeelings();
    $sadness_score = $feelings->getSadnessScore();
    ```

    d. Joy score.
    ```php
    $feelings = $analyzer->getFeelings();
    $joy_score = $feelings->getJoyScore();
    ```

    d. Disgust score.
    ```php
    $feelings = $analyzer->getFeelings();
    $disgust_score = $feelings->getDisgustScore();
    ```

    e. Trust score.
    ```php
    $feelings = $analyzer->getFeelings();
    $trust_score = $feelings->getTrustScore();
    ```

    e. Anticipation score.
    ```php
    $feelings = $analyzer->getFeelings();
    $anticipation_score = $feelings->getAnticipationScore();
    ```

    e. Surprise score.
    ```php
    $feelings = $analyzer->getFeelings();
    $surprise_score = $feelings->getSurpriseScore();
    ```

## Example of usage
```php
require dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
$analyzer = new wapmorgan\TextEmotions\EnTextEmotions($text);
$analyzer->analyze();
```

## Languages
For this moment only English language is described (file data/en.json) and `EnTextEmotions` class should be used for analyzing.

Language files stored in `data` dir.

## Accuracy
Accuracy of analyzing fully depends on dictionary.

## Goals
What it can be used for?
I've prepared list of use-cases:

- Mood detection in support tickets.
- Mood detection in forum posts.
- Mood detection in your personal mail.

## Test script

Run `test/analyze.php` and pass some text as argument or use a file instead:
```
php test/analyze.php "Here is a test text" "and this is part two"
/* or */
php test/analyze.php Here is a test text and this is part two
/* or */
php test/analyze.php -f filename.txt
```

Example of scanning:

    Metric: positivity (20) [++++++++++++++++++++--------------------------------------------------------------------------------] negativity (80)
    Scrore: positivity: 1 / negativity: 4
    fear: (1)
    anger: (1)
    sadness: (0)
    joy: (0)
    disgust: (0)
    trust: (0)
    anticipation: (0)
    surprise: (0)
