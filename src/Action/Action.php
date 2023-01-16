<?php

declare(strict_types=1);

namespace whatwedo\CoreBundle\Action;

use Symfony\Component\Form\Util\StringUtil;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Action
{
    /**
     * Defines the label of the action.
     * Defaults to <code>null</code>.
     * Accepts: <code>string|null</code>.
     */
    public const OPT_LABEL = 'label';

    /**
     * Defines the attributes of the action. These attributes are used to render the action.
     * Defaults to an empty array <code>[]</code>.
     * Accepts: <code>array</code>.
     */
    public const OPT_ATTR = 'attr';

    /**
     * Defines the icon of the action. We use bootstrap icons here. If the bootstrap class is <code>bi bi-arrow-90deg-up</code> you can use <code>arrow-90deg-up</code> here.
     * Defaults to <code>null</code>.
     * Accepts: <code>string|null</code>.
     */
    public const OPT_ICON = 'icon';

    /**
     * Defines the route of the action.
     * Defaults to <code>null</code>.
     * Accepts: <code>string|null</code>.
     */
    public const OPT_ROUTE = 'route';

    /**
     * Defines the route parameters of the action.
     * Defaults to an empty array <code>[]</code>.
     * Accepts: <code>array|callable</code>.
     */
    public const OPT_ROUTE_PARAMETERS = 'route_parameters';

    /**
     * Defines the voter attribute of the action. If this attribute is not granted to the current user it will not be rendered.
     * Defaults to <code>null</code>.
     * Accepts: <code>string|object|null</code>.
     */
    public const OPT_VOTER_ATTRIBUTE = 'voter_attribute';

    /**
     * Defines the render priority of the action. The lower the number the higher the priority.
     * Defaults to <code>0</code>.
     * Accepts: <code>int</code>.
     */
    public const OPT_PRIORITY = 'priority';

    /**
     * Defines weather the action should ask for confirmation before executing.
     * Defaults to <code>null</code>.
     * Accepts: <code>array|null</code>.
     */
    public const OPT_CONFIRMATION = 'confirmation';

    /**
     * Defines the confirmation message of the action. Use as key in the <code>OPT_CONFIRMATION</code> option.
     * Accepts: <code>string</code>.
     */
    public const OPT_CONFIRMATION_YES = 'yes';

    /**
     * Defines the confirmation message of the action. Use as key in the <code>OPT_CONFIRMATION</code> option.
     * Accepts: <code>string</code>.
     */
    public const OPT_CONFIRMATION_NO = 'no';

    /**
     * Defines the confirmation message of the action. Use as key in the <code>OPT_CONFIRMATION</code> option.
     * Accepts: <code>string</code>.
     */
    public const OPT_CONFIRMATION_LABEL = 'label';

    /**
     * Defines the twig block to render the block with. See <code>views/includes/_action.html.twig</code> for more information.
     * Be sure that your custom Action classes end with <code>Action</code>.
     * Defaults to Action's class name without the namespace in snake case.
     * Accepts: <code>string</code>.
     */
    public const OPT_BLOCK_PREFIX = 'block_prefix';

    /**
     * @var array<string, mixed>
     */
    protected array $defaultOptions = [
        self::OPT_LABEL => null,
        self::OPT_ATTR => [],
        self::OPT_ICON => null,
        self::OPT_ROUTE => null,
        self::OPT_ROUTE_PARAMETERS => [],
        self::OPT_VOTER_ATTRIBUTE => null,
        self::OPT_PRIORITY => 0,
        self::OPT_CONFIRMATION => null,
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $allowedTypes = [
        self::OPT_LABEL => ['string', 'null'],
        self::OPT_ATTR => 'array',
        self::OPT_ICON => ['string', 'null'],
        self::OPT_ROUTE => ['string', 'null'],
        self::OPT_ROUTE_PARAMETERS => ['array', 'callable'],
        self::OPT_VOTER_ATTRIBUTE => ['string', 'null', 'object'],
        self::OPT_PRIORITY => 'int',
        self::OPT_CONFIRMATION => ['array', 'null'],
        self::OPT_BLOCK_PREFIX => 'string',
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
            self::OPT_BLOCK_PREFIX => StringUtil::fqcnToBlockPrefix(static::class),
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
        return $this->getOption(self::OPT_CONFIRMATION) !== null;
    }

    public function getConfirmation(string $key): string
    {
        $confirmation = $this->getOption(self::OPT_CONFIRMATION);

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
        return $this->getOption(self::OPT_ROUTE);
    }

    /**
     * @return string[]
     */
    public function getRouteParameters(?object $entity = null): array
    {
        if (is_callable($this->getOption(self::OPT_ROUTE_PARAMETERS))) {
            return $this->getOption(self::OPT_ROUTE_PARAMETERS)($entity);
        }

        return $this->getOption(self::OPT_ROUTE_PARAMETERS);
    }

    public function getIcon(): ?string
    {
        return $this->getOption(self::OPT_ICON);
    }

    public function getLabel(): ?string
    {
        return $this->getOption(self::OPT_LABEL);
    }

    public function getVoterAttribute(): ?string
    {
        return $this->getOption(self::OPT_VOTER_ATTRIBUTE);
    }
}
