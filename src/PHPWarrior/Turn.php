<?php

namespace PHPWarrior;

class Turn {

  public $action = null;
  public $senses = [];
  public $abilities;

  public function __construct($abilities) {
    $this->abilities = $abilities;
  }

  public function __call($name, $arguments) {
    if ($this->action) {
      throw new Exception("Only one action can be performed per turn.");
    }
    if (!$this->abilities[$name]->is_sense) {
      return $this->action = [$name, $arguments];
    } else {
      return call_user_func_array(
        [$this->abilities[$name], 'perform'],
        $arguments
      );
    }
  }
}
