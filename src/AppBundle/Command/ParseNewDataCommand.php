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
    /** @var EntityManager */
    private $em;

    /** @var OutputInterface */
    private $output;

    /**
     * (non-PHPDoc)
     */
    protected function configure()
    {
        $this->setName('app:remove-hidden-domain');
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
        $this->output = $output;
        $this->em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $this->domainRepository = $this->em->getRepository(Domain::class);

        /** @var Domain[] $domainsToRemove */
        $result = $this->em->createQuery('SELECT d.id FROM CoreBundle\Entity\Domain d WHERE d.hidden = true')->getScalarResult();

        $domainsIds = array_column($result, "id");
        foreach ($domainsIds as $domainId) {
            $domain = $this->domainRepository->find($domainId);
            $this->output->writeln('Remove domain with id: ' . $domain->getId());
            $this->em->remove($domain);
            $this->em->flush();
            $this->em->clear();
        }
    }
}
