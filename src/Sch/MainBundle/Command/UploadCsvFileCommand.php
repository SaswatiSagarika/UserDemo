<?php
/**
 * Command used for Users section to upload csv file.
 *
 * @author Saswati
 *
 * @category Custom Command
 */
namespace Sch\MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UploadCsvFileCommand extends ContainerAwareCommand
{
    /**
     * Function to set the name, description and argument for the upload:csv-file command.
     */
    protected function configure()
    {
        $this
            ->setName('upload:csv-file')
            ->setDescription('create new users in users table')
            ->addArgument(
                'csv_file',
                InputArgument::REQUIRED,
                'The CSV file that contains user data'
            )
        ;
    }
    /**
     * Function to execute the upload:csv-file command to upload to .
     *
     *@param $input
     *@param $output
     *
     *@return $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $container = $this->getContainer();
        $csvFile = $input->getArgument('csv_file');
        $ext = pathinfo($csvFile, PATHINFO_EXTENSION);
        //check if the file extension is csv or not
        if($ext === 'csv')
        {   //calling the uploadUsers function
            $status = $container->get('sch_main.import_csv')->uploadUsers($csvFile);
        }
        else
        {
            $status = "Only .csv file is accepted! Try again.";
        }
        $output->writeln('<fg=magenta>'.json_encode($status).'</fg=magenta>');
    }

}