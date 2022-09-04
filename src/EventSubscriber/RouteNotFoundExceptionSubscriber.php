<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class RouteNotFoundExceptionSubscriber implements EventSubscriberInterface {

    public function __construct(
        private Environment $environment
    ) {
    }

    public static function getSubscribedEvents()
    : array {

        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    : void {

        if ($event->getThrowable() instanceof NotFoundHttpException) {
            $event->allowCustomResponseCode();
            $response = new Response(
                $this->environment->render('index/index.html.twig'),
                Response::HTTP_OK
            );
            $event->setResponse($response);
        }
    }
}
