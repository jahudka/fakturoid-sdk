<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\AbstractEntity;
use Jahudka\FakturoidSDK\Utils;


/**
 * @template T of AbstractEntity
 * @extends AbstractEndpoint<T>
 */
abstract class AbstractBillable extends AbstractEndpoint  {
    use SearchableTrait,
        DateFilterableTrait,
        SubjectFilterableTrait;

    /**
     * @param T|int $entity
     * @return $this
     */
    protected function fireEvent($entity, string $event, array $data = null) {
        if ($entity instanceof AbstractEntity) {
            $entity = $entity->getId();
        }

        $response = $this->api->sendRequest($this->url . '/' . $entity . '/fire.json?event=' . $event, 'POST', $data);
        $this->assertStatus($response, 200);
        return $this;
    }

    /**
     * @param T|int $expense
     * @param \DateTime|string|int $paidAt
     * @return $this
     */
    public function pay($expense, $paidAt = null) {
        $data = $paidAt ? ['paid_at' => Utils::formatDateTime($paidAt)] : null;
        return $this->fireEvent($expense, 'pay', $data);
    }

    /**
     * @param T|int $expense
     * @return $this
     */
    public function removePayment($expense) {
        return $this->fireEvent($expense, 'remove_payment');
    }

    /**
     * @return $this
     */
    public function withNumber(string $number) {
        return $this->setOption('number', $number);
    }

    /**
     * @return $this
     */
    public function withStatus(string $status) {
        return $this->setOption('status', $status);
    }
}
