<?php

namespace App\Command;

use App\Message\MessageTest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ServiceCli extends Command
{
    protected static $defaultName = 'service:create-event';

    protected int $serviceId;
    protected MessageBusInterface $messageBus;

    public function __construct(ContainerBagInterface $bag, MessageBusInterface $messageBus)
    {
        parent::__construct();

        $this->messageBus = $messageBus;
        $this->serviceId = $bag->get('app.service_id');
    }

    protected function configure()
    {
        $this->setDescription('Throws event');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        error_log('[ServiceCli] service #' . $this->serviceId);
        $this->messageBus->dispatch(new MessageTest(
            'Message from service #' . $this->serviceId . ' , timestamp : ' . date('Y-m-d H:i:s')
        ));

        return Command::SUCCESS;
    }
}