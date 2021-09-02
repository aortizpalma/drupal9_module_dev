<?php

namespace Drupal\goodbye_world;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Prepares the farewell to the world.
 */
class GoodbyeWorldFarewell {

  use StringTranslationTrait;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The event dispatcher.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * GoodbyeWorldFarewell constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
   *   The event dispatcher.
   */
  public function __construct(ConfigFactoryInterface $config_factory, EventDispatcherInterface $eventDispatcher) {
    $this->configFactory = $config_factory;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * Returns the farewell.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   The farewell message.
   */
  public function getFarewell() {
    $config = $this->configFactory->get('goodbye_world.custom_farewell');
    $farewell = $config->get('farewell');
    if ($farewell !== "" && $farewell) {
      $event = new FarewellEvent();
      $event->setValue($farewell);
      $this->eventDispatcher->dispatch(FarewellEvent::EVENT, $event);
      return $event->getValue();
    }

    $time = new \DateTime();
    if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
      return $this->t('Goodbye all! Enjoy this morning');
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      return $this->t('Goodbye all! Have a nice afternoon.');
    }

    if ((int) $time->format('G') >= 18) {
      return $this->t('Goodbye all! Have a pleasant evening');
    }
  }

}
