<?php

namespace App\Command;

use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use \App\Infrastructure\Application;
use \Morphable\SimpleDatabase;

class Query extends Command
{
    protected static $defaultName = 'query';

    public function __construct(SimpleDatabase $db)
    {
        $this->db = $db;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Execute query')
            ->setHelp('yes')
            ->addArgument('sql');
    }

    private function format(array $result)
    {
        var_dump($result);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->db->query($input->getArgument('sql'))->fetchAll(\PDO::FETCH_ASSOC);

        var_dump($result);
    }
}
