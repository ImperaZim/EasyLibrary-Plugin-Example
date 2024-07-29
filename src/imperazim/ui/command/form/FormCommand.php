<?php

declare(strict_types = 1);

namespace imperazim\ui\command\form;

use pocketmine\player\Player;

use imperazim\vendor\commando\BaseCommand;
use imperazim\vendor\commando\constraint\InGameRequiredConstraint;

use imperazim\ui\UiManager;
use imperazim\ui\command\form\subcommand\LongFormSubcommand;
use imperazim\ui\command\form\subcommand\ModalFormSubcommand;
use imperazim\ui\command\form\subcommand\CustomFormSubcommand;

/**
* Class FormCommand
* @package imperazim\ui\command\form
*/
final class FormCommand extends BaseCommand {

  /**
  * FormCommand constructor.
  */
  public function __construct() {
    $file = UiManager::getFile('forms');
    parent::__construct(
      plugin: UiManager::getPlugin(),
      names: $file->get('form_command.names', ['form']),
      description: $file->get('form_command.description', ''),
    );
  }

  /**
  * Prepares the command for execution.
  */
  protected function prepare(): void {
    $this->setPermission('default.permission');
    $this->addConstraints(
      new InGameRequiredConstraint($this)
    );
    $this->registerSubcommands([
      new LongFormSubcommand(),
      new ModalFormSubcommand(),
      new CustomFormSubcommand()
    ]);
  }

  /**
  * Executes the command.
  * @param mixed $player
  * @param string $aliasUsed
  * @param array $args
  */
  public function onRun(mixed $player, string $aliasUsed, array $args): void {
    foreach ($this->getSubCommands() as $subcommand) {
      $player->sendMessage('§e/' . $subcommand->getName() . ': §7' . $subcommand->getUsage());
    }
  }
}