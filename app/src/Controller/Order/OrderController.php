<?php

declare(strict_types=1);

namespace App\Controller\Order;

use App\Command\CommandHandlerInterface;
use App\Controller\Order\Create\Request\CreateOrderRequest;
use App\Entity\OrderId;
use App\Query\Order\GetOrder\GetOrderQuery;
use App\Query\QueryDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

class OrderController extends AbstractController
{
    public function __construct(
        private readonly CommandHandlerInterface $handler,
        private readonly QueryDispatcherInterface $dispatcher,
    ) {
    }

    #[Route('/api/order', name: 'api.order.create', methods: ['POST'])]
    public function createOrder(
        #[MapRequestPayload] CreateOrderRequest $request
    ): JsonResponse {
        try {
            $orderId = OrderId::generate();
            $command = $request->getCommand($orderId);
            $this->handler->handle($command);

            return $this->getOrder($orderId);
        } catch (\Exception $exception) {
            return $this->json($exception->getMessage(), $exception->getCode());
        }
    }

    #[Route('/api/order/{id}', name: 'api.order.read', methods: ['GET'])]
    public function getOrder(
        OrderId $id
    ): JsonResponse {
        $query = new GetOrderQuery($id);
        $result = $this->dispatcher->dispatch($query);

        return $this->json($result);
    }
}
