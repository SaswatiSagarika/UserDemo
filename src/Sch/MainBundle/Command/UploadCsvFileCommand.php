<?php

namespace Sch\MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UploadCsvFileCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('upload:csv-file')
            ->setDescription('...')
            ->addArgument(
                'csv_file',
                InputArgument::REQUIRED,
                'The CSV file that contains consumer data'
            )
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $container = $this->getContainer();
        $csvFile = $input->getArgument('csv_file');
        $ext = pathinfo($csvFile, PATHINFO_EXTENSION);
        // var_dump($csvFile);exit;
        if($ext === 'csv')
        {
            $status = $container->get('sch_main.import_csv')->uploadUsers($csvFile);
        }
        else
        {
            $status = "Only .csv file is accepted! Try again.";
        }
        $output->writeln('<fg=magenta>'.json_encode($status).'</fg=magenta>');
    }

}
