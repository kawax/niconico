# niconico API

[![Build Status](https://travis-ci.org/kawax/niconico.svg?branch=master)](https://travis-ci.org/kawax/niconico)

## Requirements
PHP >= 7.0.0

## 実装済みAPI
自分で使う用なので必要なAPIのみ実装。

- getthumbinfo http://dic.nicovideo.jp/a/%E3%83%8B%E3%82%B3%E3%83%8B%E3%82%B3%E5%8B%95%E7%94%BBapi
- コンテンツ検索API http://site.nicovideo.jp/search-api-docs/search.html

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
$query->filters(['filters[mylistCounter][gte]=10000', 'filters[commentCounter][gte]=100000']);

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

## エンドポイントが変更されたら
publicプロパティなので変更できる。

```php
$search = new Search();
$search->endpoint = 'http...';
```

## LICENSE
MIT  
Copyright kawax
