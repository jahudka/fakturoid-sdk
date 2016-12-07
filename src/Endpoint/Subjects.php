<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Subject;


/**
 * @method Subject get(int $id)
 * @method Subject[] getIterator(int $offset = null, int $limit = null)
 * @method Subject create(array $data)
 * @method Subject save(Subject $subject)
 * @method $this delete(Subject|int $subject)
 */
class Subjects extends AbstractEndpoint {
    use SearchableTrait,
        DateFilterableTrait,
        CustomFilterableTrait;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/subjects', Subject::class);
    }

    /**
     * @return array
     */
    protected function getKnownOptions() {
        return [
            'since',
            'updated_since',
            'custom_id',
            'query',
        ];
    }

}
