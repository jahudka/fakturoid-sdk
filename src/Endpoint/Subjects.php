<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Subject;


/**
 * @extends AbstractEndpoint<Subject>
 */
class Subjects extends AbstractEndpoint {
    use SearchableTrait,
        DateFilterableTrait,
        CustomFilterableTrait;

    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/subjects', Subject::class);
    }

    protected function getKnownOptions(): array {
        return [
            'since',
            'updated_since',
            'custom_id',
            'query',
        ];
    }
}
