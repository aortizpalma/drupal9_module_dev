<?php

namespace Drupal\goodbye_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\goodbye_world\GoodbyeWorldFarewell;

/**
 * Goodbye World Farewell block.
 *
 * @Block(
 *  id = "goodbye_world_farewell_block",
 *  admin_label = @Translation("Goodbye world farewell"),
 * )
 */
class GoodbyeWorldFarewellBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The farewell service.
   *
   * @var \Drupal\goodbye_world\GoodbyeWorldFarewell
   */
  protected $farewell;

  /**
   * Constructs a GoodbyeWorldFarewellBlock.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\goodbye_world\GoodbyeWorldFarewell $farewell
   *   The farewell service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, GoodbyeWorldFarewell $farewell) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->farewell = $farewell;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('goodbye_world.farewell')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->farewell->getFarewell(),
    ];
  }

}
