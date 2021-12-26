<?php

namespace App\MessageHandler;

use App\Message\MessageTest;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MessageTestHandler implements MessageHandlerInterface
{
    protected int $serviceId;

    public function __construct(ContainerBagInterface $bag)
    {
        $this->serviceId = $bag->get('app.service_id');
    }

    public function __invoke(MessageTest $message)
    {
        error_log('[MessageTestHandler] service #' . $this->serviceId);
        error_log('[MessageTestHandler] Message received : ' . $message->getContent());
    }
}
