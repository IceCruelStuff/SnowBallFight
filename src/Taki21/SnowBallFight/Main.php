<?php

namespace Taki21\SnowBallFight;

use pocketmine\{Server,Player};
use pocketmine\plugin\{Plugin,PluginBase};
use pocketmine\event\player\{PlayerDeathEvent,PlayerInteractEvent};
use pocketmine\event\Listener;
use pocketmine\tile\Sign;
use pocketmine\utils\TextFormat as C;
use pocketmine\level\{Level,Position};
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\scheduler\PluginTask;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info(C::GREEN."Enabled!");
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new GameTime($this), 6000);
    }
    public function joinGame(PlayerInteractEvent $e){
        $p = $e->getPlayer();
        $b = $e->getBlock();
        $l = $p->getLevel();
        $sign = $l->getTile($b);
        $txt = $sign->getText();
        if($sign instanceof Sign){
            $txt = $sign->getText();
            if($txt[0] == C::RED."[Join]"){
                if($txt[1] instanceof Level){
                    $level = $this->getServer()->getLevelByName($txt[1]);
                    $level->loadChunk($level->getFloorX(), $level->getFloorZ());
                    $p->teleport(new Position(104.7,83,39.4,$level));
                    $p->setNameTag(C::RED."".$p->getName()."");
                    $players = count($this->getServer()->getLevelByName("sa1")->getPlayers());
                    $sign->setText(C::RED."[Join]",C::YELLOW."$players Players",C::AQUA."SnowArena",C::GREEN."-----");
                    
                    // Items
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                    $p->getInventory()->addItem(Item::get(332,0,64));
                }
            }else{
                if($txt[0] == C::BLUE."[Join]"){
                    if($txt[1] instanceof Level){
                        $level = $this->getServer()->getLevelByName($txt[1]);
                        $level->loadChunk($level->getFloorX(), $level->getFloorZ());
                        $p->teleport(new Position(26.7,82,15.7,$level));
                        $p->setNameTag(C::BLUE."".$p->getName()."");
                        $players = count($this->getServer()->getLevelByName("sa1")->getPlayers());
                        $sign->setText(C::BLUE."[Join]",C::YELLOW."$players Players",C::AQUA."SnowArena",C::GREEN."-----");
                        
                        // Items
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                        $p->getInventory()->addItem(Item::get(332,0,64));
                    }
                }
            }
        } // End ALL Ifs  
    }
}

// Game Timer
class GameTime extends PluginTask{
    
    public function __construct($plugin){
		$this->plugin = $plugin;
		parent::__construct($plugin);
	}
    
    public function onRun($tick){
        $players = $this->plugin->getServer()->getLevelByName("sa1")->getPlayers();
        $tick--;
        if($tick == 6000){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 5 Minutes!");
        }
        if($tick == 4800){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 4 Minutes!");
        }
        if($tick == 3600){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 3 Minutes!");
        }
        if($tick == 2400){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 2 Minutes!");
        }
        if($tick == 1200){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 1 Minute!");
        }
        if($tick == 600){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 30 Seconds!");
        }
        if($tick == 300){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 15 Seconds!");
        }
        if($tick == 200){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 10 Seconds!");
        }
        if($tick == 100){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 5 Seconds!");
        }
        if($tick == 80){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 4 Seconds!");
        }
        if($tick == 60){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 3 Seconds!");
        }
        if($tick == 40){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 2 Seconds!");
        }
        if($tick == 20){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending In 1 Seconds!");
        }
        if($tick == 0){
            $players->sendPopup(C::GREEN."SnowBall Fight Ending!");
            $lastPlayer = count($this->plugin->getServer()->getLevelByName("sa1")->getPlayers());
            if($lastPlayer == 1){
                if($lastPlayer->getName() == C::BLUE.$lastPlayer->getName()){
                    $lastPlayer->sendPopup(C::GREEN."[SnowBall Fight] Congrats ".$lastPlayer->getName()."! You Won!");
                    $this->plugin->getServer()->broadcastMessage(C::BLUE."[SnowBall Fight] The Blue Team Won! Congrats to ".$lastPlayer->getName()."!");
                }else{
                    if($lastPlayer->getName() == C::RED.$lastPlayer->getName()){
                        $lastPlayer->sendPopup(C::GREEN."[SnowBall Fight] Congrats ".$lastPlayer->getName()."! You Won!");
                        $this->plugin->getServer()->broadcastMessage(C::RED."[SnowBall Fight] The Red Team Won! Congrats to ".$lastPlayer->getName()."!");
                    }
                }
            }else{
                $players->sendPopup(C::DARK_RED."Nobody Won!");
            }
            $level = $this->plugin->getServer()->getLevelByName("world");
            $level->loadChunk($level->getFloorX(), $level->getFloorZ());
            $players->teleport(new Position(0,0,0,$level));
        }
    }
}