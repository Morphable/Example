<?php

namespace App\Command;

use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use \App\Infrastructure\Application;
use \Morphable\SimpleDatabase;

class Migrate extends Command
{
    protected static $defaultName = 'migrate';

    public function __construct(SimpleDatabase $db, string $dbPath, string $migrationPath)
    {
        $this->db = $db;
        $this->dbPath = $dbPath;
        $this->migrationPath = $migrationPath;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Migrate the database')
            ->setHelp('yes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Checking ENVIRONMENT...");

        if (!isset($_ENV['ENVIRONMENT']) || strpos(strtolower($_ENV['ENVIRONMENT']), 'prod') !== false) {
            $output->writeln("For security reasons you cannot execute this command in production");
            return;
        }

        $output->writeln("Validation parameters...");

        if (\file_exists($this->dbPath)) {
            if (substr($this->dbPath, -3) != '.db') {
                $output->writeln("Please use a database file");
                return;
            }

            \unlink($this->dbPath);
        }

        if (!\file_exists($this->migrationPath)) {
            $output->writeln("Missing migration file");
            return;
        }

        $output->writeln("Executing migrations...");

        $migrations = explode(';', \file_get_contents($this->migrationPath));
        foreach ($migrations as $migration) {
            $this->db->query($migration);
        }
    }
}
