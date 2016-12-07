<?php


namespace Jahudka\FakturoidSDK\Endpoint;


use GuzzleHttp\Psr7\Response;
use Jahudka\FakturoidSDK\AbstractEntity;
use Jahudka\FakturoidSDK\Client;

trait EventEmitterTrait {

    /** @var Client */
    protected $api;

    /** @var string */
    protected $url;

    /**
     * @param Response $response
     * @param $expectedStatus
     * @return void
     * @throws \RuntimeException
     */
    protected abstract function assertStatus(Response $response, $expectedStatus);

    /**
     * @param AbstractEntity|int $entity
     * @param string $event
     * @param array $data
     * @return $this
     */
    protected function fireEvent($entity, $event, array $data = null) {
        if ($entity instanceof AbstractEntity) {
            $entity = $entity->getId();
        }

        $response = $this->api->sendRequest($this->url . '/' . $entity . '/fire.json?event=' . $event, 'POST', $data);
        $this->assertStatus($response, 200);
        return $this;
    }

}
