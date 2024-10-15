<?php

namespace App\Services;

use DateTimeImmutable;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

class JwtService
{
    private Configuration $config;

    public function __construct()
    {
        $this->config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('66f69e45a02863ddc4e4c7b58550e0e87b725bfc3489e6969507c45387740c4c') 
        );
    }

    public function generateToken(array $claims): Plain
    {
        $now = new DateTimeImmutable();
        return $this->config->builder()
            ->issuedBy('thet-phoo-ngon') // Issuer
            ->permittedFor('http://vendingmachine.com') // Audience
            ->issuedAt($now) // Time when the token was issued
            ->expiresAt($now->modify('+24 hour')) 
            ->withClaim('uid', $claims['user_id']) // Add custom claims
            ->getToken($this->config->signer(), $this->config->signingKey());
    }

    public function validateToken($token): bool
    {   
        $token = $this->config->parser()->parse($token);

        $constraints = [
            new SignedWith($this->config->signer(), $this->config->signingKey()),
            new ValidAt(SystemClock::fromSystemTimezone())
        ];
        return $this->config->validator()->validate($token, ...$constraints);
    }

    public function getTokenClaims(string $token): array
    {
        $token = $this->config->parser()->parse($token);
        return $token->claims()->all();
    }
}
