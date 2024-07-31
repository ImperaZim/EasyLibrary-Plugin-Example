<?php

declare(strict_types = 1);

namespace imperazim\entity;

use imperazim\components\plugin\PluginToolkit;
use imperazim\components\plugin\PluginComponent;
use imperazim\components\plugin\traits\PluginComponentsTrait;

use imperazim\vendor\customies\block\Model;
use imperazim\vendor\customies\block\Material;
use imperazim\vendor\customies\item\CreativeInventoryInfo;
use imperazim\vendor\customies\entity\CustomiesEntityFactory;

/**
* Class EntityManager
* @package imperazim\entity
*/
final class EntityManager extends PluginComponent {
  use PluginComponentsTrait;

  /**
  * Initializes the entity component.
  * @param PluginToolkit $plugin The Plugin.
  */
  public static function init(PluginToolkit $plugin): array {
    /**
    * Define the main instance to make the code easier and there is no need to define getInstance in main if you are adding it just for that! However, it is not mandatory.
    */
    self::setPlugin(plugin: $plugin);

    /**
    * To register a custom block, you must pass the custom entity class and network type id.
    *
    */
    $entities = [
      Slayer::class
    ];
    foreach ($entities as $entity) {
      $factory = CustomiesEntityFactory::getInstance();
      $factory->registerEntity(
        $entity::class,
        $entity::getNetworkTypeId(),
      );
    }

    /**
    * Registers the subcomponents of the current component.
    * View on ComponentTypes [COMMAND, LISTENER, SCHEDULER, NETWORK]
    */
    return [];
  }

}