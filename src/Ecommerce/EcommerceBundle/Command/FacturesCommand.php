<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 30/09/2016
 * Time: 20:44
 */

namespace Ecommerce\EcommerceBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Users\UsersBundle\Entity\Commandes;

class FacturesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName("ecommerce:factures")
            ->setDescription("this is a command test")
            ->addArgument('date',InputArgument::OPTIONAL,'La date pour laquelle vous souhaitez récuperer les factures.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = $input->getArgument('date');

        if($date == null)
        {
            $output->writeln('Pas de date passee en argument, la date d\'aujourd\'hui sera consideree !');
            $date = new \DateTime();
            $output->writeln('En recherche de factures dont la date est posterieure a '.date_format($date,'d/m/y h:i:s' ).'...');
        }
        else
        {
            $date = new \DateTime($date);
            
            $output->writeln('En recherche de factures dont la date est posterieure a '.date_format($date,'d/m/y h:i:s' ).'...');
        }

        $factures = $this->getContainer()->get('doctrine')->getRepository('UsersBundle:Commandes')->ByDateCommande($date);

        $path = realpath($this->getContainer()->get('kernel')->getRootDir() . "/../");

        $output->writeln(count($factures).' factures trouvees.');

        /**
         * @var $facture Commandes
         */
        
        if(count($factures) > 0)
        {
            $dir = $date->format('d M Y h-i-s');
            mkdir('Factures/'.$dir);
            foreach($factures as $facture)
                $this->getContainer()->get('generatePDF')->generatePDF($facture)->
                Output($path.'/Factures/'.$dir.'/facture-'.$facture->getReference().'.pdf','F');
        }

    }


}