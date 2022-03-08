<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK;


/**
 * @template T of AbstractEntity
 * @implements \Iterator<T>
 */
class EndpointIterator implements \Iterator {
    private Client $api;
    private string $url;
    private array $options;
    /** @var class-string<T> */
    private string $entityClass;
    private ?int $offset;
    private ?int $limit;
    private ?int $pages = null;
    private int $page = 1;
    private int $item = 0;
    private ?array $buffer = null;

    /**
     * @param class-string<T> $entityClass
     */
    public function __construct(
        Client $api,
        string $url,
        array $options,
        string $entityClass,
        ?int $offset = null,
        ?int $limit = null
    ) {
        $this->api = $api;
        $this->url = $url;
        $this->options = $options;
        $this->entityClass = $entityClass;
        $this->offset = $offset;
        $this->limit = $limit;

    }

    /**
     * @return T
     */
    public function current(): AbstractEntity {
        return new $this->entityClass($this->buffer[$this->item]);
    }

    public function next(): void {
        ++$this->item;

        if ($this->limit) {
            ++$this->limit;
        }

        if ($this->item >= Client::ITEMS_PER_PAGE) {
            $this->item = 0;
            ++$this->page;
            $this->loadPage();
        }
    }

    public function key(): int {
        return ($this->page - 1) * Client::ITEMS_PER_PAGE + $this->item;
    }

    public function valid(): bool {
        if ($this->limit !== null && $this->limit <= 0) {
            return false;
        }

        return $this->pages !== null && $this->page < $this->pages || ($this->pages === null || $this->page === $this->pages) && $this->item < count($this->buffer);
    }

    public function rewind(): void {
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

    private function loadPage(): void {
        $response = $this->api->sendRequest($this->buildUrl());

        if (($paging = $response->getHeaderLine('Link')) && preg_match('/<([^>]+)>; rel="last"/', $paging, $m)) {
            parse_str(parse_url($m[1], PHP_URL_QUERY), $query);

            if (isset($query['page'])) {
                $this->pages = (int)$query['page'];
            }
        }

        $this->buffer = json_decode($response->getBody()->getContents(), true);
    }

    private function buildUrl(): string {
        $params = [
            'page' => $this->page,
        ];

        if ($this->options) {
            $params += $this->options;
        }

        return $this->url . '?' . http_build_query($params);
    }
}
