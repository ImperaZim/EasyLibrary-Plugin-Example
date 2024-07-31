<?php

namespace imperazim\entity;

use pocketmine\entity\Living;
use pocketmine\entity\EntitySizeInfo;
use imperazim\vendor\customies\entity\CustomiesEntityFactory;

/**
* Class Slayer
* @package imperazim\entity
*/
final class Slayer extends Living {

  protected bool $gravityEnabled = false;
  
  public static function getNetworkTypeId() : string {
    return EntityIds::SLAYER;
  }

  public function getName() : string {
    return "Slayer";
  }

  public function getInitialSizeInfo() : EntitySizeInfo {
    return new EntitySizeInfo(height: 1, width: 1, eyeHeight: null);
  }
}