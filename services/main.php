<?php 
    // error_reporting(0); // stops all error reporting
    function escape($string) {
        return htmlentities($string, ENT_QUOTES); // searches for applicable characters in the user input and prevents them from being applied as they may be part of malicious code; converts both single and double quotes
    }
    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email: The email address
     * @param string $size: Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $default: Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
     * @param string $rating: Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $image: True to return a complete IMG tag False for just the URL
     * @param array $attributes: Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    function getGravatar($email, $size = 160, $default = 'mp', $rating = 'g', $image = false, $attributes = array()) {
        $url = "https://www.gravatar.com/avatar/";
        $url .= md5(strtolower(trim($email))); // md5 hashing algorithm
        $url .= "?s={$size}&d={$default}&r={$rating}";
        if ($image) {
            $url = '<img src="' . $url . '"';
            foreach ($attributes as $key => $value) {
                $url .= ' ' . $key . '="' . $value . '"';
            }
            $url .= ' />';
        }
        return $url;
    }
    function createCurrencyFormat($numericString) {
        if ($numericString != 0) {
            $formatter = new NumberFormatter("de_DE", NumberFormatter::CURRENCY);
            return $formatter->formatCurrency($numericString, "EUR");
        } else {
            return "";
        }
    }
    function createStars($integer) {
        $result = '';
        if ($integer > 0) {
            for ($i = 0; $i < $integer; $i++) {
                $result .= '<span class="fullStar">&starf;</span>';
            }
            for ($i = 0; $i < 5 - $integer; $i++) {
                $result .= '<span class="emptyStar">&star;</span>';
            }
        } else {
            $result = '<span class="notRated">not rated</span>';
        }
        return $result;
    }
?>