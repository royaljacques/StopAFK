<?php
/*

   *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
   *  .d88888b           d88888P                   d88888P d88  d88  *
   *  88.    "'              d8'                       d8'  88   88  *
   *  `Y88888b. .d8888b.    d8'  .d8888b. 88d888b.    d8'   88   88  *
   *        `8b 88ooood8   d8'   88ooood8 88'  `88   d8'    88   88  *
   *  d8'   .8P 88.  ...  d8'    88.  ... 88    88  d8'     88   88  *
   *   Y88888P  `88888P' d8'     `88888P' dP    dP d8'     d88P d88P *
   *     Original plugin by DXM_Hip. Updated to API 3 by Se7en711    *
   *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *

*/
namespace Se7en711\StopAFK\task;

use pocketmine\scheduler\Task;
use Se7en711\StopAFK\Main;

class checkAfk extends Task {

    public function __construct(Main $plugin) {
         $this->plugin = $plugin;
    }

    public function onRun($currentTick)
    {
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
           if(!isset($this->plugin->time[$player->getName()]))
           {
           $this->plugin->setTime($player);
           }

           if(!isset($this->plugin->pos[$player->getName()]))
           {
           $this->plugin->setPos($player);
           }

           if(!$this->plugin->hasMoved($player)){
           $this->plugin->removePlayer($player);

           }elseif(!$this->plugin->isPlayerSet($player))
           {
           $this->plugin->setPlayer($player);
           }
        }
        $this->plugin->checkTime();

    }
}
