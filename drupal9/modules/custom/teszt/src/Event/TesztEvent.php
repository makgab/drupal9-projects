<?php

namespace Drupal\teszt\Event;

use Symfony\Component\EventDispatcher\Event;


class TesztEvent extends Event
{
  protected $valami;

  public function __construct($valami)
  {
    $this->valami = $valami;
  }

  public function getValami()
  {
    return $this->valami;
  }
}
