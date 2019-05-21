# niconico API

[![Build Status](https://travis-ci.com/kawax/niconico.svg?branch=master)](https://travis-ci.com/kawax/niconico)
[![Maintainability](https://api.codeclimate.com/v1/badges/4e9a1edcc42746a6786f/maintainability)](https://codeclimate.com/github/kawax/niconico/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/4e9a1edcc42746a6786f/test_coverage)](https://codeclimate.com/github/kawax/niconico/test_coverage)

## Requirements
PHP >= 7.1.3

## 実装済みAPI
自分で使う用なので必要なAPIのみ実装。

- getthumbinfo https://dic.nicovideo.jp/a/%E3%83%8B%E3%82%B3%E3%83%8B%E3%82%B3%E5%8B%95%E7%94%BBapi
- コンテンツ検索API https://site.nicovideo.jp/search-api-docs/search.html

## Install

### Composer
```
composer require revolution/niconico
```

## Usage

### example1
```php
<?php
use Revolution\Niconico\Search;
use Revolution\Niconico\Search\Query;

$query = new Query();
$query->q = "初音ミク";
$query->targets = 'title,tags';
$query->_sort = "-viewCounter";
$query->filters(['filters[mylistCounter][gte]=10000', 'filters[commentCounter][gte]=100000']);

$search = new Search();

// returns object
$response = $search->service('video')->search($query);

// returns array
$response = $search->service('video')->search($query, true);
```

### example2
```php
<?php
use Revolution\Niconico\Search\Query;

$query = new Query([
  'q'        => '初音ミク',
  'targets'  => 'title,tags',
  '_sort'    => '-viewCounter',
]);
```

### example3
```php
<?php
use Revolution\Niconico\Search\Query;

$query = Query::create([
  'q'        => '初音ミク',
  'targets'  => 'title,tags',
  '_sort'    => '-viewCounter',
])->filters([]);
```

### example4
```php
<?php
use Revolution\Niconico\ThumbInfo;

$thumb = new ThumbInfo();

$thumb->get('sm9');

var_dump($thumb->video_id);//'sm9'

var_dump($thumb->toJson());
var_dump($thumb->toArray());
var_dump($thumb->toSimpleObject());
```

## エンドポイントが変更されたら
publicプロパティなので変更できる。

```php
$search = new Search();
$search->endpoint = 'http...';
```

## LICENSE
MIT  
Copyright kawax
