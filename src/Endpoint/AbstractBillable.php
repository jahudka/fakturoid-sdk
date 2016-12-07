<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\AbstractEntity;
use Jahudka\FakturoidSDK\Utils;


abstract class AbstractBillable extends AbstractEndpoint  {
    use SearchableTrait,
        DateFilterableTrait,
        SubjectFilterableTrait;

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

    /**
     * @param AbstractEntity|int $expense
     * @param \DateTime|string|int $paidAt
     * @return $this
     */
    public function pay($expense, $paidAt = null) {
        $data = $paidAt ? ['paid_at' => Utils::formatDateTime($paidAt)] : null;
        return $this->fireEvent($expense, 'pay', $data);
    }

    /**
     * @param AbstractEntity|int $expense
     * @return $this
     */
    public function removePayment($expense) {
        return $this->fireEvent($expense, 'remove_payment');
    }

    /**
     * @param string $number
     * @return $this
     */
    public function withNumber($number) {
        return $this->setOption('number', $number);
    }

    /**
     * @param string $status
     * @return $this
     */
    public function withStatus($status) {
        return $this->setOption('status', $status);
    }
}
