<?php

namespace App\Helpers\Helpers;
use App\Models\ReportCategory;

class Helper {

    public static function getFirstFiveWords($string) {
        $endWord = 'Market';
        $endPos = stripos($string, $endWord);
        if ($endPos === false) {
            $firstThreerWords = array_slice(explode(" ", trim($string)) , 0, 3);
            return implode(' ',$firstThreerWords);
        }
        $result = trim(substr($string, 0, $endPos + strlen($endWord)));
        return $result;
    }

    public static function getCategoryNameById($id){
        $cat_name = ReportCategory::where('status','!=','delete')->where('id',$id)->select('category_name')->first();
        return $cat_name->category_name;
    }

    public static function rupeesToWords($amount) {
        $ones = array(
            0 => 'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $tens = array(
            0 => '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
        );
        $suffixes = array(
            10000000 => 'crore',
            100000 => 'lakh',
            1000 => 'thousand',
            100 => 'hundred',
            1 => ''
        );

        if ($amount == 0) {
            return $ones[0] . ' ' . $suffixes[1];
        }

        $words = '';
        foreach ($suffixes as $number => $suffix) {
            if ($amount >= $number) {
                $count = floor($amount / $number);
                $amount %= $number;

                if ($count > 0) {
                    if ($count < 20) {
                        $words .= $ones[$count] . ' ';
                    } elseif ($count < 100) {
                        $words .= $tens[floor($count / 10)];

                        // Exclude unnecessary zeros
                        if ($count % 10 !== 0) {
                            $words .= ' ' . $ones[$count % 10];
                        }
                        $words .= ' ';
                    } else {
                        $words .= rupeesToWords($count) . ' ';
                    }

                    $words .= $suffix . ' ';
                }
            }
        }

        return trim(preg_replace('/\s+/', ' ', $words));
    }
}