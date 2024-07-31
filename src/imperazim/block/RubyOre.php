<?php

declare(strict_types = 1);

namespace imperazim\block;

use pocketmine\item\Item;
use pocketmine\block\Opaque;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;

use imperazim\item\Ruby;
use imperazim\vendor\customies\item\CustomiesItemFactory;

/**
* Class RubyOre
* @package imperazim\block
*/
class RubyOre extends Opaque {

  public const NAME = 'Ruby Ore';
  public const IDENTIFIER = 'ruby_ore';

  /**
  * RubyOre constructor.
  */
  public function __construct() {
    parent::__construct(
      new BlockIdentifier(BlockTypeIds::newId()),
      self::NAME,
      new BlockTypeInfo(new BlockBreakInfo(0.3)),
      self::IDENTIFIER
    );
  }

  public function getFrictionFactor(): float {
    return 0.4;
  }

  public function getDropsForCompatibleTool(Item $item): array {
    return [
      CustomiesItemFactory::getInstance()->get(Ruby::IDENTIFIER)
    ];
  }

  public function isAffectedBySilkTouch(): bool {
    return true;
  }


  protected function getXpDropAmount(): int {
    return mt_rand(3, 7);
  }
}