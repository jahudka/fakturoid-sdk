<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Report;


class Reports {
    const BY_DATE_ISSUED = null,
        BY_DATE_PAID = 'paid',
        BY_TAXABLE_FULFILLMENT_DATE = 'vat';

    private Client $api;

    public function __construct(Client $api) {
        $this->api = $api;
    }

    public function getYear(?int $year = null, ?string $type = self::BY_DATE_ISSUED): Report {
        $url = 'accounts/' . $this->api->getSlug() . '/reports/' . ($year ?: date('Y')) . ($type ? '/' . $type : '') . '.json';
        $response = $this->api->sendRequest($url);
        $payload = json_decode($response->getBody()->getContents(), true);
        return new Report($payload);
    }
}
