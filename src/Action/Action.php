<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Action;

use Symfony\Component\Form\Util\StringUtil;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Action
{
    /**
     * @var array<string, mixed>
     */
    protected array $defaultOptions = [
        'label' => null,
        'attr' => [],
        'icon' => null,
        'route' => null,
        'route_parameters' => [],
        'voter_attribute' => null,
        'priority' => 0,
        'confirmation' => null,
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $allowedTypes = [
        'label' => ['string', 'null'],
        'attr' => 'array',
        'icon' => ['string', 'null'],
        'route' => ['string', 'null'],
        'route_parameters' => ['array', 'callable'],
        'voter_attribute' => ['string', 'null', 'object'],
        'priority' => 'int',
        'confirmation' => ['array', 'null'],
        'block_prefix' => 'string',
    ];

    /**
     * @param array<string, mixed> $options
     *                                      it's possible to pass functions as option value to create dynamic labels, routes and more
     */
    public function __construct(
        protected string $acronym,
        protected array $options
    ) {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(array_merge([
            'block_prefix' => StringUtil::fqcnToBlockPrefix(static::class),
        ], $this->defaultOptions));

        foreach ($this->allowedTypes as $key => $types) {
            $resolver->setAllowedTypes($key, $types);
        }

        $this->options = $resolver->resolve($this->options);
    }

    public function getOption(string $name): mixed
    {
        if (! $this->hasOption($name)) {
            throw new \InvalidArgumentException(sprintf('Option "%s" for %s does not exist.', $name, static::class));
        }

        return $this->options[$name];
    }

    public function setOption(string $name, mixed $value): static
    {
        if (! $this->hasOption($name)) {
            throw new \InvalidArgumentException(sprintf('Option "%s" for %s does not exist.', $name, static::class));
        }

        $this->options[$name] = $value;

        return $this;
    }

    public function hasConfirmation(): bool
    {
        return $this->getOption('confirmation') !== null;
    }

    public function getConfirmation(string $key): string
    {
        $confirmation = $this->getOption('confirmation');

        return $confirmation[$key] ?? '';
    }

    public function hasOption(string $name): bool
    {
        return isset($this->options[$name]) || array_key_exists($name, $this->options);
    }

    public function getAcronym(): string
    {
        return $this->acronym;
    }

    public function getRoute(): ?string
    {
        return $this->getOption('route');
    }

    /**
     * @return string[]
     */
    public function getRouteParameters(?object $entity = null): array
    {
        if (is_callable($this->getOption('route_parameters'))) {
            return $this->getOption('route_parameters')($entity);
        }

        return $this->getOption('route_parameters');
    }

    public function getIcon(): ?string
    {
        return $this->getOption('icon');
    }

    public function getLabel(): ?string
    {
        return $this->getOption('label');
    }

    public function getVoterAttribute(): ?string
    {
        return $this->getOption('voter_attribute');
    }
}
