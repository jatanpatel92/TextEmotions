<?php
namespace wapmorgan\TextEmotions;

class TextFeelings {
    protected $fear;
    protected $anger;
    protected $sadness;
    protected $joy;
    protected $disgust;
    protected $trust;
    protected $anticipation;
    protected $surprise;

    public function init($feeling, $score) {
        if (property_exists($this, $feeling))
            $this->{$feeling} = $score;
    }

    public function __call($method, $args) {
        if (strncasecmp($method, 'get', 3) === 0 && substr_compare($method, 'score', -5,  strlen($method), true) === 0) {
            $feeling = substr($method, 3, -5);
            if (property_exists($this, $feeling)) {
                return $this->feeling;
            }
        }
    }

    public function iterator() {
        return get_object_vars($this);
    }
}