<?php

namespace SandhyR;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{


    private $spec;
    public $taskid;

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "spec":
                if ($sender instanceof Player) {
                    if (isset($args[0]) and !isset($this->spec[$sender->getName()])) {
                        $player = $this->getServer()->getPlayer($args[0]);
                        if ($player !== null) {
                            $this->getScheduler()->scheduleRepeatingTask(new SpectateTask($this, $sender->getName(), $player->getName()), 20);
                            $this->spec[$sender->getName()] = $sender->getName();
                        }
                    } elseif (!isset($args[0])) {
                        $sender->sendMessage("Usage /spec <playername>");
                    } elseif (isset($this->spec[$sender->getName()])) {
                        $this->getScheduler()->cancelTask($this->taskid[$sender->getName()]);
                        unset($this->spec[$sender->getName()]);
                    }

                }
        }
        return true;
    }
}
