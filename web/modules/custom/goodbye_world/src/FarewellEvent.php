<?php

namespace Drupal\goodbye_world;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event class to be dispatched from the GoodbyeWorldFarewell service.
 */
class FarewellEvent extends Event {

  const EVENT = 'goodbye_world.farewell_event';

  /**
   * The farewell message.
   *
   * @var string
   */
  protected $message;

  /**
   * Returns the farewell message.
   *
   * @return mixed
   *   The farewell message.
   */
  public function getValue() {
    return $this->message;
  }

  /**
   * Sets the farewell message.
   *
   * @param mixed $message
   *   The farewell message.
   */
  public function setValue($message) {
    $this->message = $message;
  }

}
