<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Event;
use Jahudka\FakturoidSDK\MemberAccessException;

/**
 * @method Event get(int $id)
 * @method Event[] getIterator(int $offset = null, int $limit = null)
 *
 * @property-read Events $paid
 */
class Events extends AbstractEndpoint {

    /** @var bool */
    protected $readonly = true;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/events', Event::class);
    }

    /**
     * @return array
     */
    public function getKnownOptions() {
        return [];
    }

    /**
     * @param string $name
     * @return Events
     * @throws MemberAccessException
     */
    public function __get($name) {
        if ($this->original && $name === 'paid') {
            $endpoint = clone $this;
            $endpoint->url .= '/' . $name;
            return $endpoint;
        }

        $class = get_class($this);
        throw new MemberAccessException("Trying to access non-existent property '$name' of class $class");
    }
}
