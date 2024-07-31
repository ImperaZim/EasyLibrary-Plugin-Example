<?php

declare(strict_types = 1);

namespace imperazim\block;

use imperazim\components\plugin\PluginToolkit;
use imperazim\components\plugin\PluginComponent;
use imperazim\components\plugin\traits\PluginComponentsTrait;

use imperazim\vendor\customies\block\Model;
use imperazim\vendor\customies\block\Material;
use imperazim\vendor\customies\item\CreativeInventoryInfo;
use imperazim\vendor\customies\block\CustomiesBlockFactory;

use pocketmine\math\Vector3;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier as BI;

/**
* Class BlockManager
* @package imperazim\block
*/
final class BlockManager extends PluginComponent {
  use PluginComponentsTrait;

  /**
  * Initializes the block component.
  * @param PluginToolkit $plugin The Plugin.
  */
  public static function init(PluginToolkit $plugin): array {
    /**
    * Define the main instance to make the code easier and there is no need to define getInstance in main if you are adding it just for that! However, it is not mandatory.
    */
    self::setPlugin(plugin: $plugin);

    /**
    * To register a custom block, you must pass the custom block class, an identifier (identifier and the id referring to the block, for example "diamond_ore"), an model, and Creative Category, an serializer and deserializer.
    *
    */
    $blocks = [
      RubyOre::class
    ];
    foreach ($blocks as $block) {
      $factory = CustomiesBlockFactory::getInstance();
      $factory->registerBlock(
        className: $block,
        identifier: $block::IDENTIFIER,
        model: new Model(
          [
            new Material(Material::TARGET_ALL, $block::IDENTIFIER, Material::RENDER_METHOD_ALPHA_TEST)
          ],
          "geometry.block",
          new Vector3(-8, 0, -8),
          new Vector3(16, 16, 16),
        ),
        creativeInfo: new CreativeInventoryInfo(
          CreativeInventoryInfo::CATEGORY_ITEMS,
          CreativeInventoryInfo::NONE
        ),
        serializer: null,
        deserializer: null
      );
    }

    /**
    * Registers the subcomponents of the current component.
    * View on ComponentTypes [COMMAND, LISTENER, SCHEDULER, NETWORK]
    */
    return [];
  }

}