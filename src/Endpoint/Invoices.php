<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Invoice;
use Jahudka\FakturoidSDK\MemberAccessException;
use Jahudka\FakturoidSDK\Utils;


/**
 * @extends AbstractBillable<Invoice>
 * @property-read Invoices $regular
 * @property-read Invoices $proforma
 *
 * @method $this markAsSent(Invoice|int $invoice)
 * @method $this deliver(Invoice|int $invoice)
 * @method $this pay(Invoice|int $invoice, \DateTime|string|int $paidAt = null)
 * @method $this payProforma(Invoice|int $invoice)
 * @method $this payPartialProforma(Invoice|int $invoice)
 * @method $this removePayment(Invoice|int $invoice)
 * @method $this deliverReminder(Invoice|int $invoice)
 * @method $this cancel(Invoice|int $invoice)
 * @method $this undoCancel(Invoice|int $invoice)
 */
class Invoices extends AbstractBillable {
    use CustomFilterableTrait;

    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/invoices', Invoice::class);
    }

    protected function getKnownOptions(): array {
        return [
            'since',
            'updated_since',
            'until',
            'updated_until',
            'custom_id',
            'subject_id',
            'number',
            'status',
            'query',
        ];
    }

    /**
     * @param \DateTime|string|int $date
     * @return $this
     */
    public function until($date) {
        return $this->setOption('until', Utils::formatDateTime($date));
    }

    /**
     * @param \DateTime|string|int $date
     * @return $this
     */
    public function updatedUntil($date) {
        return $this->setOption('updated_until', Utils::formatDateTime($date));
    }

    /**
     * @param Invoice|int $invoice
     * @return $this
     */
    public function sendMessage($invoice, array $params = []) {
        if ($invoice instanceof Invoice) {
            $invoice = $invoice->getId();
        }

        $params = array_intersect_key(Utils::toPascalKeys($params), ['email' => 1, 'email_copy' => 1, 'subject' => 1, 'message' => 1]);

        $response = $this->api->sendRequest($this->url . '/' . $invoice . '/message.json', 'POST', $params);
        $this->assertStatus($response, 201);

        return $this;
    }

    public function __call(string $name, array $args) {
        if (in_array($name, ['markAsSent', 'deliver', 'payProforma', 'payPartialProforma', 'deliverReminder', 'cancel', 'undoCancel'], true)) {
            if (empty($args)) {
                throw new \InvalidArgumentException("First argument of " . __CLASS__ . "::$name() must be an integer or an instance of Invoice, none given");
            }

            return $this->fireEvent($args[0], Utils::toPascalCase($name));
        }

        $class = get_class($this);
        $types = implode(', ', array_map('gettype', $args));
        throw new MemberAccessException("Call to undefined method $class::$name($types)");
    }

    public function __get(string $name) {
        if ($this->original && in_array($name, ['regular', 'proforma'], true)) {
            $endpoint = clone $this;
            $endpoint->url .= '/' . $name;
            return $endpoint;
        }

        $class = get_class($this);
        throw new MemberAccessException("Trying to access non-existent property '$name' of class $class");
    }
}
