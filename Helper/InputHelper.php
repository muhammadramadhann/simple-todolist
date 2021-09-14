<?php

namespace Helper {

    class InputHelper
    {
        static function input(string $input)
        {
            echo "$input";
            $result = fgets(STDIN);
            return trim($result);
        }
    }
}