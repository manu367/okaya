<?php
class DSA {
    private $dsa;
    function __construct($arr) {
        sort($arr);              // old-school discipline
        $this->dsa = $arr;
    }
    public function twoPointerAlgorithm($target) {
        $left = 0;
        $right = count($this->dsa) - 1;

        while ($left < $right) {
            $result = $this->dsa[$left] + $this->dsa[$right];

            if ($result === $target) {
                return ["first"=>$this->dsa[$left],"second"=> $this->dsa[$right],"result"=>$result];
            } elseif ($result < $target) {
                $left++;
            } else {
                $right--;
            }
        }
        return null;
    }
    public function slidingWindow($arr, $window) {
        $n = count($arr);
        if ($window > $n) {
            return null; // window bada ho gaya, logic toot jaayega
        }
        $windowSum = 0;
        for ($i = 0; $i < $window; $i++) {
            $windowSum += $arr[$i];
        }
        $maxSum = $windowSum;
        for ($i = $window; $i < $n; $i++) {
            $windowSum = $windowSum - $arr[$i - $window] + $arr[$i];
            $maxSum = max($maxSum, $windowSum);
        }
        return $maxSum;
    }

}

$arr = [21,23,90,57,3,2,4];
$ds = new DSA($arr);

$result = $ds->twoPointerAlgorithm(7);
print_r($result);
echo $ds->slidingWindow($arr, 3);
