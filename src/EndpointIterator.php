<?php


namespace Jahudka\FakturoidSDK;



class EndpointIterator implements \Iterator {

    /** @var Client */
    private $api;

    /** @var string */
    private $url;

    /** @var array */
    private $options;

    /** @var string */
    private $entityClass;

    /** @var int */
    private $offset;

    /** @var int */
    private $limit;

    /** @var int */
    private $pages = null;

    /** @var int */
    private $page = 1;

    /** @var int */
    private $item = 0;

    /** @var array */
    private $buffer = null;


    /**
     * @param Client $api
     * @param string $url
     * @param array $options
     * @param string $entityClass
     * @param int $offset
     * @param int $limit
     */
    public function __construct(Client $api, $url, array $options, $entityClass, $offset, $limit) {
        $this->api = $api;
        $this->url = $url;
        $this->options = $options;
        $this->entityClass = $entityClass;
        $this->offset = $offset;
        $this->limit = $limit;

    }

    /**
     * @return AbstractEntity
     */
    public function current() {
        return new $this->entityClass($this->buffer[$this->item]);
    }


    /**
     * @return void
     */
    public function next() {
        $this->item++;

        if ($this->limit) {
            $this->limit--;
        }

        if ($this->item >= Client::ITEMS_PER_PAGE) {
            $this->item = 0;
            $this->page++;
            $this->loadPage();
        }
    }

    /**
     * @return int
     */
    public function key() {
        return ($this->page - 1) * Client::ITEMS_PER_PAGE + $this->item;
    }

    /**
     * @return bool
     */
    public function valid() {
        if ($this->limit !== null && $this->limit <= 0) {
            return false;
        }

        return $this->pages !== null && $this->page < $this->pages || ($this->pages === null || $this->page === $this->pages) && $this->item < count($this->buffer);

    }

    /**
     * @return void
     */
    public function rewind() {
        $this->pages = null;

        if ($this->offset !== null) {
            $this->page = floor($this->offset / Client::ITEMS_PER_PAGE) + 1;
            $this->item = $this->offset % Client::ITEMS_PER_PAGE;
        } else {
            $this->page = 1;
            $this->item = 0;
        }

        $this->loadPage();
    }

    /**
     * @return void
     */
    private function loadPage() {
        $response = $this->api->sendRequest($this->buildUrl());

        if (($paging = $response->getHeaderLine('Link')) && preg_match('/<([^>]+)>; rel="last"/', $paging, $m)) {
            parse_str(parse_url($m[1], PHP_URL_QUERY), $query);

            if (isset($query['page'])) {
                $this->pages = (int)$query['page'];
            }
        }

        $this->buffer = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return string
     */
    private function buildUrl() {
        $params = [
            'page' => $this->page,
        ];

        if ($this->options) {
            $params += $this->options;
        }

        return $this->url . '?' . http_build_query($params);
    }
}
