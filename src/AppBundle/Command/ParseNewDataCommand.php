<?php
namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RemoveHiddenDomainCommand
 */
class ParseNewDataCommand extends ContainerAwareCommand
{
    /**
     * (non-PHPDoc)
     */
    protected function configure()
    {
        $this->setName('app:load');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('near_earth_object_loader_service')->loadNearEarthObjects();
    }
}
