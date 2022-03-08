<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Event;
use Jahudka\FakturoidSDK\MemberAccessException;

/**
 * @extends AbstractEndpoint<Event>
 * @property-read Events $paid
 */
class Events extends AbstractEndpoint {
    protected bool $readonly = true;

    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/events', Event::class);
    }

    public function getKnownOptions(): array {
        return [];
    }

    public function __get(string $name) {
        if ($this->original && $name === 'paid') {
            $endpoint = clone $this;
            $endpoint->url .= '/' . $name;
            return $endpoint;
        }

        $class = get_class($this);
        throw new MemberAccessException("Trying to access non-existent property '$name' of class $class");
    }
}
