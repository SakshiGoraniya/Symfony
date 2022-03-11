<?php

namespace App\Command;
use  Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RandomSpellCommand extends Command
{
    protected static $defaultName = 'app:random-spell';
    protected static $defaultDescription = 'Add a short description for your command';
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('cast a random spell')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'your name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'yell?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourname = $input->getArgument('your-name');

        if ($yourname) {
            $io->note(sprintf('Hiii: %s', $yourname));
        }
   
        $spells = [
            'alohomora',
            'confundo',
            'engorgio',
            'expecto patronum',
            'expelliarmus',
            'impedimenta',
            'reparo',
        ];
        $spell= $spells[array_rand($spells)];

        if ($input->getOption('yell')) {
            $spell = strtoupper($spell);
        }
        $this->logger->info('Casting spell: '.$spell);

        // if ($input->getOption('option1')) {
        //     // ...
        // }
        $io->success($spell);
        return 0;


        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        // return Command::SUCCESS;
    }
}
