# niconico API

[![Build Status](https://travis-ci.org/kawax/niconico.svg?branch=master)](https://travis-ci.org/kawax/niconico)

## 実装済みAPI
自分で使う用なので必要なAPIのみ実装。

- getthumbinfo
- http://search.nicovideo.jp/docs/api/search.html

## Install

### Composer
```
composer require revolution/niconico
```

## Usage

### example1
```php
use Niconico\Search;
use Niconico\Search\Query;

$query = new Query();
$query->q = "初音ミク";
$query->targets = 'title,tags';
$query->_sort = "-viewCounter";

$search = new Search();

// returns object
$response = $search->service('video')->search($query);

// returns array
$response = $search->service('video')->search($query, true);
```

### example2
```php
use Niconico\ThumbInfo;

$thumb = new ThumbInfo();

$thumb->get('sm9');

var_dump($thumb->video_id);//'sm9'

var_dump($thumb->toJson());
var_dump($thumb->toArray());
var_dump($thumb->toSimpleObject());
```

## LICENSE
MIT  
Copyright kawax
