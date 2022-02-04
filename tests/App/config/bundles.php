<?php

declare(strict_types=1);

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => [
        'all' => true,
    ],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => [
        'all' => true,
    ],
    Symfony\Bundle\TwigBundle\TwigBundle::class => [
        'all' => true,
    ],
    whatwedo\CoreBundle\whatwedoCoreBundle::class => [
        'all' => true,
    ],
    whatwedo\TwigBootstrapIcons\whatwedoTwigBootstrapIconsBundle::class => [
        'all' => true,
    ],
];
