<?php

namespace Drupal\hello_world;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Prepares the salutation to the world.
 */
class HelloWorldSalutation {

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
   * HelloWorldSalutation constructor.
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
   * Returns the salutation.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   The salutation message.
   */
  public function getSalutation() {
    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation = $config->get('salutation');
    if ($salutation !== "" && $salutation) {
      $event = new SalutationEvent();
      $event->setValue($salutation);
      $this->eventDispatcher->dispatch(SalutationEvent::EVENT, $event);
      return $event->getValue();
    }

    $time = new \DateTime();
    if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
      return $this->t('Good morning world from Group Daddies');
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      return $this->t('Good afternoon world from Group Daddies');
    }

    if ((int) $time->format('G') >= 18) {
      return $this->t('Good evening world from Group Daddies');
    }
  }




  /**
   * Returns the salutation render array.
   */

  public function getSalutationComponent() {

    $render = [
      '#theme' => 'hello_world_salutation',
    ];
    $config = $this->configFactory->get('hello_world.custom_salutation');
    $salutation = $config->get('salutation');
    if ($salutation !== "" && $salutation) {
      $event = new SalutationEvent();
      $event->setValue($salutation);
      $this->eventDispatcher->dispatch(SalutationEvent::EVENT, $event);
      $render['#salutation'] = $event->getValue();
      $render['#overridden'] = TRUE;
      return $render;
    }
    $time = new \DateTime();
    $render['#target'] = $this->t('world');
    if ((int) $time->format('G') >=00 && (int) $time->format('G') < 12){
      $render['#salutation'] = $this->t('Good morning');
      return $render;
    }
    if ((int) $time->format('G') >=12 && (int) $time->format('G') < 18){
      $render['#salutation'] = $this->t('Good afternoon');
      return $render;
    }
    if ((int) $time->format('G') >=18){
      $render['#salutation'] = $this->t('Good evening');
      return $render;
    }

  }

}