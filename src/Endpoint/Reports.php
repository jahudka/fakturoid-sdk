<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Report;
use function GuzzleHttp\json_decode;


class Reports {

    const BY_DATE_ISSUED = null,
        BY_DATE_PAID = 'paid',
        BY_TAXABLE_FULFILLMENT_DATE = 'vat';

    /** @var Client */
    private $api;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        $this->api = $api;
    }

    /**
     * @param int $year
     * @param string $type
     * @return Report
     */
    public function getYear($year = null, $type = self::BY_DATE_ISSUED) {
        $url = 'accounts/' . $this->api->getSlug() . '/reports/' . ($year ?: date('Y')) . ($type ? '/' . $type : '') . '.json';
        $response = $this->api->sendRequest($url);
        $payload = json_decode($response->getBody()->getContents(), true);
        return new Report($payload);
    }

}
