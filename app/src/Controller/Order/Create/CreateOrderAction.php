<?php

declare(strict_types=1);

namespace App\Controller\Order\Create;

use App\Command\CommandHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/order', name: 'api_order_create', methods: ['POST'])]
class CreateOrderAction extends AbstractController
{
    public function __construct(
        private readonly CommandHandlerInterface $handler,
    )
    {

    }

    public function __invoke(
        #[MapRequestPayload] CreateOrderRequest $request
    )
    {
        $command = $request->getCommand();
        try {
            $this->handler->handle($command);
            return $this->json('Order created');
        } catch (\Exception $exception) {
            return $this->json($exception->getMessage(), 400);
        }
    }
}
