<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Todo;
use Jahudka\FakturoidSDK\Utils;
use function GuzzleHttp\json_decode;


/**
 * @method Todo get(int $id)
 * @method Todo[] getIterator(int $offset = null, int $limit = null)
 */
class Todos extends AbstractEndpoint {

    /** @var bool */
    protected $readonly = true;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/todos', Todo::class);
    }

    /**
     * @return array
     */
    public function getKnownOptions() {
        return [
            'since',
        ];
    }

    /**
     * @param \DateTime|string|int $date
     * @return $this
     */
    public function since($date) {
        return $this->setOption('since', Utils::formatDate($date));
    }

    /**
     * @param Todo|int $todo
     * @return Todo
     */
    public function markAsCompleted($todo) {
        if ($todo instanceof Todo) {
            $id = $todo->getId();
        } else {
            $id = $todo;
            $todo = new Todo();
        }

        $response = $this->api->sendRequest($this->url . '/' . $id . '/toggle_completion.json', 'POST');
        $this->assertStatus($response, 200);
        $payload = json_decode($response->getBody()->getContents(), true);
        $todo->setData($payload);

        return $todo;
    }
}
