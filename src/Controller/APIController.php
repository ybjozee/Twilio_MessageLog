<?php

namespace App\Controller;

use App\Service\MessageLogService;
use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

#[Route('/api/', name: 'app_api_')]
class APIController extends AbstractController {

    public function __construct(
        private MessageLogService $messageLogService,
        private CacheInterface    $cache
    ) {
    }

    #[Route('messages', name: 'get_messages', methods: ['GET'])]
    public function getMessages()
    : JsonResponse {

        $messages = $this->cache->get(
            'messages',
            function (CacheItemInterface $cacheItem) {

                $cacheItem->expiresAfter(300);

                return $this->messageLogService->getMessages();
            }
        );

        return $this->json(
            [
                'data' => $messages,
            ]
        );
    }

    #[Route('message/{messageSid}', name: 'get_message', methods: ['GET'])]
    public function getMessage(string $messageSid)
    : JsonResponse {

        $message = $this->cache->get(
            "message_$messageSid",
            fn() => $this->messageLogService->getMessage($messageSid)
        );

        return $this->json(
            [
                'data' => $message,
            ]
        );
    }

    #[Route('message/{messageSid}', name: 'delete_message', methods: ['DELETE'])]
    public function deleteMessage(string $messageSid)
    : JsonResponse {

        $this->messageLogService->deleteMessage($messageSid);
        $this->cache->delete("message_$messageSid");

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}