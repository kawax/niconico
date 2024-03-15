<?php

namespace Revolution\Niconico\Search;

/**
 * マジックメソッドを使うことにより項目が追加・変更されても大丈夫なようにしている。
 *
 * Class Query.
 */
class Query
{
    protected array $filters = [];

    protected array $query;

    public function __construct(array $query = null)
    {
        $this->query = $query ?? [
            'q' => '初音ミク',
            'targets' => 'title,tags',
            'fields' => 'contentId,title,description,tags,startTime,viewCounter,thumbnailUrl',
            '_sort' => '-startTime',
            '_offset' => '0',
            '_limit' => '10',
            '_context' => 'niconico',
        ];
    }

    public static function create(array $query = null): Query
    {
        return new static($query);
    }

    public function build(): string
    {
        $query = http_build_query($this->query, '', '&', PHP_QUERY_RFC3986);

        if (! empty($this->filters)) {
            $query .= '&'.implode('&', $this->filters);
        }

        return $query;
    }

    public function filters(array $filters): Query
    {
        $this->filters = $filters;

        return $this;
    }

    public function __get(string $property)
    {
        if (array_key_exists($property, $this->query)) {
            return $this->query[$property];
        } else {
            return null;
        }
    }

    public function __set(string $property, $value)
    {
        $this->query[$property] = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->query[$name]);
    }

    public function __unset(string $name)
    {
        unset($this->query[$name]);
    }
}
