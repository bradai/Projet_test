<?php
/**
 * Created by PhpStorm.
 * User: fhm
 * Date: 16/03/17
 * Time: 16:50
 */

namespace AppBundle\Command;

use AppBundle\Entity\Fioul;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class CreateCommand extends ContainerAwareCommand
{


    protected function configure()
    {
        // Nom et description de la commande app/console command
        $this
            ->setName('import:csv')
            ->setDescription('Import users from CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Affichage lorsque le script est lancé
        $now = new \DateTime();
        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

        // Import CSV dans DB avec Doctrine ORM
        $this->import($input, $output);

        // Afficher quand le script est terminé
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
    }

    protected function import(InputInterface $input, OutputInterface $output)
    {

        // Obtenir un ensemble de données PHP de CSV
        $data = $this->get($input, $output);

        $em = $this->getContainer()->get('doctrine')->getManager();

        // Désactivation des requêtes de journaux par défaut de doctrine pour enregistrer la mémoire
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        // Définir la taille de l'enregistrement, la fréquence pour la persistance des données et l'index actuel des enregistrements
        $size = count($data);
        $batchSize = 10000;
        $i = 1;

        // Progression de départ
        $progress = new ProgressBar($output, $size);
        $progress->start();

        $n=0;
        $prix=array();
        $moyenne = null;

        foreach($data as $row) {
            $prix[$n]=$row['amount'];
            $n++;

        }
        $moyenne = array_sum($prix)/count($prix);

        // Traitement sur chaque rangée de données
        foreach($data as $row) {



            $fioul = new Fioul();
            $fioul->setCodePostal($row['postal_code_id']);
            $fioul->setAmount($row['amount']);
            $fioul->setAmountMoyen($moyenne);
            $fioul->setDate(\DateTime::createFromFormat('Y-m-d', $row['date']));

            // Persist
            $em->persist($fioul);

            if (($i % $batchSize) === 0) {

                $em->flush();
                $em->clear();

                $progress->advance($batchSize);

                $now = new \DateTime();
                $output->writeln(' of users imported ... | ' . $now->format('d-m-Y G:i:s'));

            }

            $i++;


        }


        //  clear data dans queue
        $em->flush();
        $em->clear();


        $progress->finish();
    }

    protected function get(InputInterface $input, OutputInterface $output)
    {

        $fileName = 'web/exercice/prices.csv';
        $converter = $this->getContainer()->get('import.csvtoarray');
        $data = $converter->convert($fileName, ',');

        return $data;
    }

} 