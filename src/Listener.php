<?php
/**
 * Created by PhpStorm.
 * User: locki
 * Date: 27-Nov-18
 */

namespace CustomCBL;

use pocketmine\command\Command;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat as R;

class Listener extends PluginBase implements Listener{

	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onDamage(EntityDamageByEntityEvent  $event): void{
		if($event->isCancelled()) return;
		if($event instanceof EntityDamageByEntityEvent){
			$victim = $event->getEntity();
			$attacker = $event->getDamager();
			if($victim instanceof Player and $attacker instanceof Player){
				foreach([$victim, $attacker] as $g);
					if(!$this->isTagged($g)) {
						$g->sendMessage(R::RED . "You are in" . R::DARK_RED ."combat!");
					}
					$this->setTagged($p, true, 30);
			}
		}
	}
}

	public function onDeath(PlayerDeathEvent $event): void{
	$player = $event->getPlayer();
	if($this->isTagged($player)){
		$this->setTagged($player, false);
	}
}

	public function onCommandPreProcess(PlayerCommandPreprocessEvent $event){
	$player = $event->getPlayer();
	if($this->istagged($player)){
		$message = $event->getMessage();
		if(strpos($message, "/") === 0){
			$args = array_map("striplashes", str_getcsv(substr($message, 1), " "));
			$label = "";
			$target = $this->plugin->getServer()->getCommandMap()->matchCommand($label, $args);
			if($target instanceof Command and in_array(strtolower($label), $this->blockedCommands)){
				$event->setCancelled();
				$player->sendMessage(R::RED . "Sorry, I see you are in combat. You can't use that command just yet.");
			}
		}
	}
}

	public function onQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();
		if($this->isTagged($player)){
			$player->kill();
		}
	}

	public function setTagged($player, $vvalue = true, int $time = 10){
	if($player instanceof Player) $player = $player->getName();
	if($value){
		$this->players[$player] = $time;
	} else{
		unset($this->players[$player]);
	}
}
	public function isTagged($player){
	if($player instanceof Player) $player = $player->getName();
	return isset($this->taggedPlayers[$player]);
}

	public function getTagDuration($player){
	if($player instanceof Player) $player = $player->getName();
	return ($this->isTagged($player) ? $this->players[$player] : 0);
}