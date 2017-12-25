<?php

namespace QuiverlyRivalry;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\item\Item;
use pocketmine\item\WrittenBook;
use pocketmine\item\WritableBook;

class Main extends PluginBase implements Listener{
    
    public function onLoad(){
        $this->getLogger()->info("Plugin Loading, castleraidepe.tk 19132, join xD!");
    }

    public function onEnable(){
        $this->getLogger()->info("Plugin enabled!");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        switch ($cmd->getName()) {
            case "book":
                if ($sender->hasPermission("book.command")) {
                    if ($sender instanceof Player) {
                        # Gives actual book
                        $this->giveBook($sender);
                    }
                }
                break;
        }
        return true;
    }
                 
    public function giveBook(Player $sender){
        # Gives book with setPageText on them
        $book = Item::get(Item::WRITTEN_BOOK, 0, 1);
        $book->setTitle(C::GREEN . C::UNDERLINE . "Information Booklet");
        $book->setPageText(0, C::GREEN . C::UNDERLINE . "Whats a Kingdom?" . C::BLACK . "\n - A kingdom, is your home, its like a fations. Except bigger! \n - Kingdoms, have many members and a custom world! \n - Each kingdom has a king, this king is who you shall fight for!");
        $book->setPageText(1, C::GREEN . C::UNDERLINE . "How can my Kingdom win?" . C::BLACK . "\n - You can earn power in the weekly wars, and from PvPing enemy kingdoms! \n - You can earn power in our KOTH at warzone.");
        $book->setPageText(2, C::GREEN . c::UNDERLINE . "How do I store my loot, and get loot?" . C::BLACK . "\n - Try doing /pv 1, for a vault! \n - Go to your kingdoms world, and make a base, skybase, or lair! \n - Make sure you raid other kingdoms bases!");
        $book->setPageText(3, C::GREEN . c::UNDERLINE . "Helpful Commands" . C::BLACK . "\n- /k \n - /warpme \n - /pv \n - /shop \n - /potions \n - /ulog \n - /cp");                $book->setAuthor("CastleRaid Network");
        $sender->getInventory()->addItem($book);
    }
}
