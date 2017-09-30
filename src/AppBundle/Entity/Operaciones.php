<?php

namespace AppBundle\Entity;

class Operacion {
  protected $operando1;
  protected $operando2;
  protected $operacion;

  public function getOperando1() {
    return $this.operando1;
  }

  public function setOperando1($operando1) {
    $this->operando1  = operando1;
  }

  public function getOperando2() {
    return $this.operando1;
  }

  public function setOperando2($operando2) {
    $this->operando2  = operando2;
  }

  public function getOperacion() {
    return $this.operacion;
  }

  public function setOperacion() {
    $this->operacion  = operacion;
  }
}
