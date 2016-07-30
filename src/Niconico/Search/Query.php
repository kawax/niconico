<?php

namespace Niconico\Search;

/**
 * Class Query.
 */
class Query
{
    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var array
     */
    protected $query = [
        'q'        => '初音ミク',
        'targets'  => 'title,tags',
        'fields'   => 'contentId,title,description,tags,startTime,viewCounter,thumbnailUrl',
        '_sort'    => '-startTime',
        '_offset'  => '0',
        '_limit'   => '10',
        '_context' => 'niconico',
    ];

    /**
     * @return string
     */
    public function build()
    {
        $query = http_build_query($this->query, '', '&', PHP_QUERY_RFC3986);

        $filters = '';
        if (count($this->filters) > 0) {
            foreach ($this->filters as $filter) {
                $filters .= '&'.$filter;
            }

            $query .= $filters;
        }

        return $query;
    }

    /**
     * @param string[] $filters
     *
     * @return $this
     */
    public function filters($filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * @param $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (array_key_exists($property, $this->query)) {
            return $this->query[$property];
        } else {
            return;
        }
    }

    /**
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        $this->query[$property] = $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->query[$name]);
    }

    /**
     * @param $name
     */
    public function __unset($name)
    {
        unset($this->query[$name]);
    }
}
