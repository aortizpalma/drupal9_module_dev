<?php

namespace Drupal\goodbye_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\goodbye_world\GoodbyeWorldFarewell;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for the farewell message.
 */
class GoodbyeWorldController extends ControllerBase {

  /**
   * The farewell service.
   *
   * @var \Drupal\goodbye_world\GoodbyeWorldFarewell
   */
  protected $farewell;

  /**
   * GoodbyeWorldController constructor.
   *
   * @param \Drupal\goodbye_world\GoodbyeWorldFarewell $farewell
   *   The farewell service.
   */
  public function __construct(GoodbyeWorldFarewell $farewell) {
    $this->farewell = $farewell;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('goodbye_world.farewell')
    );
  }

  /**
   * Goodbye World.
   *
   * @return array
   *   Our message.
   */
  public function goodbyeWorld() {
    return [
      '#markup' => $this->farewell->getFarewell(),
    ];
  }

}
