<?php

namespace SandhyR;

use pocketmine\scheduler\Task;
use pocketmine\math\Vector3;

class SpectateTask extends Task{

    private $plugin;
    private $spectator;
    private $player;

    public function __construct(Main $owner, $spectator, $player)
    {
     $this->plugin = $owner;
     $this->spectator = $spectator;
     $this->player = $player;
    }

    public function onRun(int $currentTick)
    {
        $spectator = $this->plugin->getServer()->getPlayerExact($this->spectator);
        $player = $this->plugin->getServer()->getPlayerExact($this->player);
        $this->plugin->taskid[$this->spectator] = $this->getTaskId();
        if($player !== null and $spectator !== null){
            $spectator->setGamemode(3);
            $spectator->teleport(new Vector3($player->getX(), $player->getY(), $player->getZ()),$player->getYaw(), $player->getPitch());
        }

    }
}
