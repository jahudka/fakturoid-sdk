Fakturoid API v2 SDK
====================

Provides a simplified access to the Fakturoid API.

### Installation

#### Composer

1) Add the SDK repository and package to your `composer.json`:

```js
{
    // ...
    "repositories": [
        // ...
        { "type": "vcs", "url": "https://github.com/jahudka/fakturoid-sdk" }
        // ...
    ],
    "require": {
        // ...
        "jahudka/fakturoid-sdk": "dev-master"
        // ...
    }
    // ...
}
```

2) Run `composer update` in your project directory

#### Without Composer

1) Download the latest SDK PHAR archive here: https://github.com/jahudka/fakturoid-sdk/releases

2) Unpack the archive wherever you wish and load like this:

```php
<?php

require '/path/to/fakturoid-sdk.phar';
```


### Usage

Create a client:

```php
<?php
$api = Jahudka\FakturoidSDK\Client::create($email, $apiToken, $slug, $userAgent);

// or construct the instance yourself:
$httpClient = new GuzzleHttp\Client();
$api = new Jahudka\FakturoidSDK\Client($httpClient, $email, $apiToken, $slug, $userAgent);
```

The SDK covers all the currently available API endpoints as specified
in the API docs (http://docs.fakturoid.apiary.io/). The endpoints are available
through properties on the `Client` instance, for example the Invoices
endpoint is available as `$api->invoices`. The properties are named
the same as the API endpoints they access.

Data from the API is always returned wrapped in an appropriate entity
object. The entity objects have the same properties as their respective
endpoints, except that property names are camelCase instead of pascal_case.

#### Caching

Fakturoid recommends that API clients leverage common HTTP caching mechanisms
in order to speed up client apps and save bandwidth. This is very easy
to do with the FakturoidSDK because you can simply install any caching
middleware of your choice in the SDK's instance of GuzzleHttp\Client.
See for example https://github.com/Kevinrob/guzzle-cache-middleware.

#### Traversing the API

Reading list endpoints is easy using the SDK: the endpoint property
itself is an iterator aggregate, meaning that in the simplest case when
you want to read all the entries of a given endpoint you can just directly
use the endpoint in a `foreach` loop, for example:

```php
<?php

foreach ($api->invoices as $invoice) {
    // $invoice is an instance of Jahudka\FakturoidSDK\Entity\Invoice
    
    // Data can be accessed either through properties...
    echo $invoice->number;
    $invoice->number = '2016-123';
    
    // ... or through getters and setters.
    echo $invoice->getNumber();
    $invoice->setNumber('2016-123');
    
}
```

The endpoint iterator of course supports all the filtering and searching
options that the API supports, as well as SQL-style limiting, for example:

```php
<?php

$invoices = $api->invoices
    ->setOption('status', 'open');

foreach ($invoices as $invoice) {
    echo $invoice->number . "\n";
    // ...
}

// limiting can be done by calling the getIterator() method manually
// and supplying the optional $offset and $limit arguments like this:
foreach ($api->invoices->getIterator(100, 100) as $invoice) {
    // do something with invoices #100 - #199
}
```

#### Getting, creating, updating and deleting entries

```php
<?php

// Getting entries is simple:
$invoice = $api->invoices->get(981);
echo $invoice->getNumber();

// Creating new entries can be done
// using the endpoint's create() method:
$data = [
    'name' => 'Josef Novak',
    'street' => 'Dlouha 123',
    'city' => 'Nove Mesto',
    'zip' => '123 45',
    'country' => 'CZ',
    'registration_no' => '123456789',
];

$subject = $api->subjects->create($data);
echo $subject->getId();

// Or you can manually create the entity
// and use the endpoint's save() method:
$subject = new Jahudka\FakturoidSDK\Entity\Subject();

$subject->setName('Josef Novak');
// ...

$api->subjects->save($subject);

// The entity object is updated by the data returned
// from the server, so this still works:
echo $subject->getId();

// The save() method is useful for updating existing
// entries, either entities you previously loaded from
// the API somehow or even entities you constructed by hand:
$pepa = new Jahudka\FakturoidSDK\Entity\Subject();
$pepa->setId(3042);
$pepa->setPhone('+420 123 456 789');

$api->subjects->save($pepa);

// Same as before, the entity object is not only
// saved, but also updated using the data
// returned from the server:
echo $pepa->getBankAccount();

// Deleting entries can be done using the delete() method:
$api->subjects->delete($pepa);

// You can pass in just the ID:
$api->subjects->delete(123);
```