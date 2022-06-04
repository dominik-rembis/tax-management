<?php

declare(strict_types=1);

namespace App\Core\EventSubscriber\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class LoginSubscriber implements AuthenticationSuccessHandlerInterface
{
    private const RESPONSE_FORMAT = 'json';

    public function __construct(
        private SerializerInterface $serializer
    ) {}

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        return new Response(
            $this->serializer->serialize(
                $token->getUser(),
                self::RESPONSE_FORMAT
            )
        );
    }
}