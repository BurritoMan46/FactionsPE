<?php
/*
 *   88""Yb     88""Yb     88     8b    d8     88   88     .dP"Y8
 *   88__dP     88__dP     88     88b  d88     88   88     `Ybo."
 *   88"""      88"Yb      88     88YbdP88     Y8   8P     o.`Y8b
 *   88         88  Yb     88     88 YY 88     `YbodP'     8bodP'
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author Latvian PHP programmer Kristaps Drivnieks (Primus)
 * @link https://Github.com/PrimusLV/FactionsPE
 */

namespace factions\command;

use factions\command\subcommand\ClaimSubCommand;
use factions\command\subcommand\PowerBoostSubCommand;
use factions\command\subcommand\UnclaimSubCommand;
use factions\command\subcommand\CloseFactionSubCommand;
use factions\command\subcommand\CreateSubCommand;
use factions\command\subcommand\DescSubCommand;
use factions\command\subcommand\DisbandSubCommand;
use factions\command\subcommand\FlagListSubCommand;
use factions\command\subcommand\HelpSubCommand;
use factions\command\subcommand\HomeSubCommand;
use factions\command\subcommand\InfoSubCommand;
use factions\command\subcommand\ListSubCommand;
use factions\command\subcommand\InviteSubCommand;
use factions\command\subcommand\JoinSubCommand;
use factions\command\subcommand\KickSubCommand;
use factions\command\subcommand\LeaderSubCommand;
use factions\command\subcommand\LeaveSubCommand;
use factions\command\subcommand\MapSubCommand;
use factions\command\subcommand\SetPowerSubCommand;
use factions\command\subcommand\OpenFactionSubCommand;
use factions\command\subcommand\OverrideSubCommand;
use factions\command\subcommand\PermSubCommand;
use factions\command\subcommand\RelationSubCommand;
use factions\command\subcommand\SetHomeSubCommand;
use factions\command\subcommand\SetNameSubCommand;
use factions\command\subcommand\StatusSubCommand;
use factions\command\subcommand\TopSubCommand;
use factions\command\subcommand\WhoSubCommand;
use factions\FactionsPE;

use dominate\Command;
use dominate\argument\Argument;

use pocketmine\command\CommandSender;

class FactionCommand extends Command
{

    public function __construct(FactionsPE $plugin)
    {
        parent::__construct($plugin, 'faction', 'Main Faction command', FactionsPE::MAIN, ['fac', 'f']);

        // Registering subcommands
        $this->addChild(new InfoSubCommand($plugin, "info", "Fetch faction info", FactionsPE::INFO));

        $this->addArgument(new Argument("sub-command", Argument::TYPE_STRING));
    }

    /**
     * @param CommandSender $sender
     * @param string $label
     * @param string[] $args
     * @return bool|mixed
     */
    public function execute(CommandSender $sender, $label, array $args) : bool
    {
        if (!parent::execute($sender, $label, $args)) return true;

        if ($this->endPoint !== $this) return true;

        if (isset($args[0])) {
            if (!$this->getChild($args[0])) {
                $sender->sendMessage(Localizer::trans("command.generic-usage", $args[0]));
            }
        }

        return true;
    }

}