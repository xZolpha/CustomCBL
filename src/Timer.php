<?php
/**
 * Created by PhpStorm.
 * User: locki
 * Date: 27-Nov-18
 */

use pocketmine\scheduler\Task;
use pocketmine\Player;
use pocketmine\utils\TextFormat as R;

class CombatLoggerTimer extends Task{

	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onRun(in $tick): void{
		$listener = new CombatLoggerListener($this->plugin);
		foreach($listener->player as $name => $time){
			$time--;
			if($time <= 0){
				$listener->setTagged($name, false);
				$player = $this->plugin->getServer()->getPlayerExact($name);
				if($player instanceof Player) $player->sendMessage(R::GREEN . "You are no longer". R::RED . "tagged");
				return;
			}
			$listener->players[$name]--;
		}
	}

}