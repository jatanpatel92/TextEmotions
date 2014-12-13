<?php
namespace wapmorgan\TextEmotions;

class TextEmotions {
    static public $data;
    protected $text;
    protected $positivity;
    protected $negativity;
    protected $textFeelings;

    /**
     * @var string $text Text to analyze
     */
    public function __construct($text) {
        $this->text = $text;
        if (is_string(static::$data))
            static::loadData();
    }

    static private function loadData() {
        static::$data = json_decode(file_get_contents(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.static::$data), true);
    }

    public function analyze() {
        $words = str_word_count($this->text, 1);
        $frequency = array_count_values($words);

        $positivity = 0;
        $negativity = 0;
        foreach (static::$data['positive'] as $pos_word) {
            if (isset($frequency[$pos_word]))
                $positivity += $frequency[$pos_word];
        }

        foreach (static::$data['negative'] as $neg_word) {
            if (isset($frequency[$neg_word]))
                $negativity += $frequency[$neg_word];
        }

        $this->positivity = $positivity;
        $this->negativity = $negativity;

        // feelings scores
        $text_feelings = new TextFeelings();
        foreach (static::$data['feelings'] as $feeling => $fel_words) {
            $score = 0;
            array_push($fel_words, $feeling);
            foreach ($fel_words as $fel_word) {
                if (isset($frequency[$fel_word]))
                    $score += $frequency[$fel_word];
            }
            $text_feelings->init($feeling, $score);
        }

        $this->textFeelings = $text_feelings;
    }

    public function getPositivityMetric() {
        return $this->positivity === 0 ? 0 : $this->positivity * 100 / ($this->positivity + $this->negativity);
    }

    public function getPositivityScore() {
        return $this->positivity;
    }

    public function getNegativityMetric() {
        return $this->negativity === 0 ? 0 : $this->negativity * 100 / ($this->positivity + $this->negativity);
    }

    public function getNegativityScore() {
        return $this->negativity;
    }

    public function getFeelings() {
        return $this->textFeelings;
    }
}
