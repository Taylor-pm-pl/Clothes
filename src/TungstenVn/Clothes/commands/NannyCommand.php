<?php

declare(strict_types=1);

namespace TungstenVn\Clothes\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use TungstenVn\Clothes\Clothes as Loader;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use TungstenVn\Clothes\session\SessionManager;

class NannyCommand extends Command implements PluginOwned
{
    public function __construct() {
        parent::__construct(
            name: "nanny",
            description: "Clothes command",
            usageMessage: "/nanny"
        );
        $this->setPermission("nanny.clothes.command");
    }


    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$this->testPermission($sender)) {
            return;
        }
        if (!$sender instanceof Player) {
            $sender->sendMessage("§cPlease use this command in-game");
            return;
        }
        SessionManager::addPlayer($sender);
        $sender->sendMessage("§aTap a slapper to change skin");
    }

    /**
     * @return Loader
     */
    public function getOwningPlugin(): Loader
    {
        return Loader::getInstance();
    }
}