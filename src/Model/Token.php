<?php


namespace Imper86\ImmiApi\Model;


use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Token implements TokenInterface
{
    private $params;

    public function __construct(array $params)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(['access_token', 'grant_type', 'expiry']);
        $resolver->setDefault('refresh_token', null);
        $resolver->setDefault('user_id', null);
        $resolver->setAllowedTypes('access_token', 'string');
        $resolver->setAllowedTypes('grant_type', 'string');
        $resolver->setAllowedTypes('expiry', 'int');
        $resolver->setAllowedTypes('refresh_token', ['null', 'string']);
        $resolver->setAllowedTypes('user_id', ['null', 'string']);

        $this->params = $resolver->resolve($params);
    }

    public function __toString()
    {
        return $this->getAccessToken();
    }

    public function getGrantType(): string
    {
        return $this->params['grant_type'];
    }

    public function getAccessToken(): string
    {
        return $this->params['access_token'];
    }

    public function getRefreshToken(): ?string
    {
        return $this->params['refresh_token'] ?? null;
    }

    public function getUserId(): ?string
    {
        return $this->params['user_id'] ?? null;
    }

    public function getExpiry(): DateTimeImmutable
    {
        return new DateTimeImmutable('@' . $this->params['expiry']);
    }

    public function isExpired(?DateTimeInterface $now = null): bool
    {
        if (!$now) {
            $now = new DateTimeImmutable();
        }

        return $this->getExpiry() < $now;
    }

    public function serialize(): array
    {
        return $this->params;
    }
}