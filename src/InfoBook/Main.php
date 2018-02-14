<?php

namespace InfoBook;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener{

    public function onEnable() : void{
        $this->getLogger()->notice("InfoBook enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        switch($command->getName()){
            case "book":
                if(!$sender instanceof Player){
                    $sender->sendMessage(TextFormat::RED . "Use this command in-game!");
                    return false;
                }

                if(!isset($args[0])){
                    $sender->sendMessage(TextFormat::GRAY . "Usage: /book <give | help>");
                    return false;
                }

                if($args[0] === "give"){
                    if($sender->hasPermission("book.command")){
                        $this->giveBook($sender);
                    }else{
                        $sender->sendMessage(TextFormat::RED . "You do not have permission to use this command.");
                        return false;
                    }
                }

                if($args[0] === "help"){
                    if($sender->hasPermission("book.command")){
                        $sender->sendMessage(TextFormat::GREEN . TextFormat::BOLD . "-==+ InfoBook Help+==-");
                        $sender->sendMessage(TextFormat::GOLD . "Type /book to be given the book!");
                        $sender->sendMessage(TextFormat::GOLD . "Use the book.command permission with PurePerms to be able to use this command!");
                        $sender->sendMessage(TextFormat::GREEN . TextFormat::BOLD . "-====================-");
                    }else{
                        $sender->sendMessage(TextFormat::RED . "You do not have permission to use this command.");
                        return false;
                    }
                }
                break;
        }
        return true;
    }

    public function giveBook(Player $player) : void{
        $book = Item::get(Item::WRITTEN_BOOK, 0, 1);
        $book->setTitle(TextFormat::GREEN . TextFormat::UNDERLINE . "Information Booklet");
        $book->setPageText(0, TextFormat::GREEN . TextFormat::UNDERLINE . "Whats a Kingdom?" . TextFormat::BLACK . "\n - A kingdom, is your home, its like a fations. Except bigger! \n - Kingdoms, have many members and a custom world! \n - Each kingdom has a king, this king is who you shall fight for!");
        $book->setPageText(1, TextFormat::GREEN . TextFormat::UNDERLINE . "How can my Kingdom win?" . TextFormat::BLACK . "\n - You can earn power in the weekly wars, and from PvPing enemy kingdoms! \n - You can earn power in our KOTH at warzone.");
        $book->setPageText(2, TextFormat::GREEN . TextFormat::UNDERLINE . "How do I store my loot, and get loot?" . TextFormat::BLACK . "\n - Try doing /pv 1, for a vault! \n - Go to your kingdoms world, and make a base, skybase, or lair! \n - Make sure you raid other kingdoms bases!");
        $book->setPageText(3, TextFormat::GREEN . TextFormat::UNDERLINE . "Helpful Commands" . TextFormat::BLACK . "\n- /k \n - /warpme \n - /pv \n - /shop \n - /potions \n - /ulog \n - /cp");
        $book->setAuthor("CastleRaid Network");
        $player->getInventory()->addItem($book);
    }
}