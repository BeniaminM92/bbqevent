<?php

namespace App\Factory;

use App\Entity\Event;
use App\Entity\EventTypeEnum;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Event>
 */
final class EventFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Event::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'bookedseats' => self::faker()->numberBetween(50,3000),
            'description' => self::faker()->text(30),
            'name' => self::faker()->userName(),
            'eventtype' => self::faker()->randomElement(EventTypeEnum::cases()),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Event $event): void {})
        ;
    }
}
