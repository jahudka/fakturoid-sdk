<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Generator;
use Jahudka\FakturoidSDK\MemberAccessException;


/**
 * @extends AbstractEndpoint<Generator>
 * @property-read Generators $templates
 * @property-read Generators $recurring
 */
class Generators extends AbstractEndpoint {
    use DateFilterableTrait,
        SubjectFilterableTrait;

    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/generators', Generator::class);
    }

    protected function getKnownOptions(): array {
        return [
            'since',
            'updated_since',
            'subject_id',
        ];
    }

    public function __get(string $name) {
        if ($this->original && in_array($name, ['templates', 'recurring'], true)) {
            $endpoint = clone $this;
            $endpoint->url .= '/' . rtrim($name, 's');
            return $endpoint;
        }

        $class = get_class($this);
        throw new MemberAccessException("Trying to access non-existent property '$name' of class $class");
    }
}
