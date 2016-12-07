<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Generator;
use Jahudka\FakturoidSDK\MemberAccessException;


/**
 * @property-read Generators $templates
 * @property-read Generators $recurring
 *
 * @method Generator get(int $id)
 * @method Generator[] getIterator(int $offset = null, int $limit = null)
 * @method Generator create(array $data)
 * @method Generator save(Generator $generator)
 * @method $this delete(Generator|int $generator)
 */
class Generators extends AbstractEndpoint {
    use DateFilterableTrait,
        SubjectFilterableTrait;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/generators', Generator::class);
    }

    /**
     * @return array
     */
    protected function getKnownOptions() {
        return [
            'since',
            'updated_since',
            'subject_id',
        ];
    }

    /**
     * @param string $name
     * @return Generators
     * @throws MemberAccessException
     */
    public function __get($name) {
        if ($this->original && in_array($name, ['templates', 'recurring'], true)) {
            $endpoint = clone $this;
            $endpoint->url .= '/' . rtrim($name, 's');
            return $endpoint;
        }

        $class = get_class($this);
        throw new MemberAccessException("Trying to access non-existent property '$name' of class $class");
    }
}
