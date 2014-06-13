<?php

/*
ACCESSING PROPERTY OPERATORS:
Array - [] - ex. $array["prop"];
Array def or loop - => - ex. foreach($array as $key => $value) or [ "key" => "value" ]
Object - -> - ex. $obj->prop;
*/

class Tester {
  public $passed = 0;
  public $failed = 0;
  
  //test takes two arguments
  //if they're equal, the test passed
  //in that case, $this->passed += 1
  //otherwise failed, etc
  //return whether it passed
  function test($a, $b) {
    if ($a == $b) {
      $this->passed = $this->passed + 1;
      return true;
    } else {
      echo "FAIL: expected $b, got $a<br>";
      $this->failed = $this->failed + 1;
      return false;
    }
  }
}

class Calculator {
  public $currentTotal = 0;
  
  function clear() {
    $this->currentTotal = 0;
  }
  
  function add($x) {
    //$this->currentTotal += $x;
    $this->currentTotal = $this->currentTotal + $x;
  }
  
  function sub($x) {
    //$this->currentTotal -= $x;
    $this->currentTotal = $this->currentTotal - $x;
  }
  
  function mult($x) {
    $this->currentTotal *= $x;
  }
  
  function div($x) {
    $this->currentTotal /= $x;
  }
  
  function eq() {
    return $this->currentTotal;
  }
}







