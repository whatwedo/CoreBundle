<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Action;

use Symfony\Component\Form\Util\StringUtil;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Action
{
    protected array $defaultOptions = [
        'label' => null,
        'attr' => null,
        'icon' => null,
        'route' => null,
        'route_parameters' => [],
        'voter_attribute' => null,
        'priority' => 0,
        'confirm_label' => null,
        'yes_label' => null,
        'no_label' => null,
    ];

    /**
     * it's possible to pass functions as option value to create dynamic labels, routes and more.
     * TODO: create docs.
     */
    public function __construct(
        protected string $acronym,
        protected array $options
    ) {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(array_merge([
            'block_prefix' => StringUtil::fqcnToBlockPrefix(static::class),
        ], $this->defaultOptions));

        $this->options = $resolver->resolve($this->options);
    }

    public function getOption(string $name)
    {
        if (! $this->hasOption($name)) {
            throw new \InvalidArgumentException(sprintf('Option "%s" for %s does not exist.', $name, static::class));
        }

        return $this->options[$name];
    }

    public function setOption($name, $value): static
    {
        if (! $this->hasOption($name)) {
            throw new \InvalidArgumentException(sprintf('Option "%s" for %s does not exist.', $name, static::class));
        }

        $this->options[$name] = $value;

        return $this;
    }

    public function hasConfirmation(): bool
    {
        return count(array_filter([
            $this->getOption('confirm_label'),
            $this->getOption('yes_label'),
            $this->getOption('no_label'),
        ])) === 3;
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

    public function getRouteParameters(): array
    {
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
