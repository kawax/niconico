<?php
namespace Niconico\Search;

/**
 * Class Query
 * @package Niconico\Search
 */
class Query
{
    /**
     * @var array
     */
    protected $query = [
        'q' => '初音ミク',
        'targets' => 'title,tags',
        'fields' => 'contentId,title,description,tags,startTime,viewCounter,thumbnailUrl',
//        'filters' => 'filters[viewCounter][gte]=1000000',
        '_sort' => '-startTime',
        '_offset' => '0',
        '_limit' => '10',
        '_context' => 'niconico',
    ];

    /**
     * @return string
     */
    public function build()
    {
        $query = '';

        foreach ($this->query as $key => $value) {
            if ($key === 'filters') {
                $query .= urlencode($value) . '&';
            } else {
                $query .= "$key=" . urlencode($value) . '&';
            }
        }

        return $query;
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (array_key_exists($property, $this->query)) {
            return $this->query[$property];
        } else {
            return null;
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
