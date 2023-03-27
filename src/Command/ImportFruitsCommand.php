<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Service\FruitService;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'fruits:fetch',
    description: 'Add a short description for your command',
)]
class ImportFruitsCommand extends Command
{

    private $fruitService;

    public function __construct(FruitService $fruitService)
    {
        $this->fruitService = $fruitService;

        parent::__construct();
    }




    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fruitsData = $this->fruitService->createFruit();

        return Command::SUCCESS;
    }
}
