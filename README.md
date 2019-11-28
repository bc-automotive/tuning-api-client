# Tuning API Client

The bc-consulting/tuning-api-client package is a library that eases integration of the [B&C Consulting Tuning database API](https://www.bcconsulting.lu/en/#tuning-database-api) in your site.

## Installation

Install the package via composer:

``` bash
composer require bc-consulting/tuning-api-client
```

## Usage

Configure the TuningApiClient and use the Models:

```php
use \BcConsulting\TuningApiClient\TuningApiClient;

TuningApiClient::config([
	'api_token' => 'my-token',
	'api_url' => 'https://tuning-api-staging.bcconsulting.lu',
]);
print_r(TuningApiClient::vehicles());
print_r(TuningApiClient::vehicles(1));
print_r(TuningApiClient::vehicles(1)->brands());
print_r(TuningApiClient::vehicles(1)->brands(5));
print_r(TuningApiClient::vehicles(1)->brands(5)->models());
print_r(TuningApiClient::vehicles(1)->brands(5)->models(5359));
print_r(TuningApiClient::vehicles(1)->brands(5)->models(5359)->years());
print_r(TuningApiClient::vehicles(1)->brands(5)->models(5359)->years(8163));
print_r(TuningApiClient::vehicles(1)->brands(5)->models(5359)->years(8163)->powertrains());
print_r(TuningApiClient::vehicles(1)->brands(5)->models(5359)->years(8163)->powertrains(8165));

```

In case you have a premium subscription, then you also have access to these methods to retrieve brand logo and miniatures:

```php
print_r(TuningApiClient::vehicles(1)->brands(5)->logo());
print_r(TuningApiClient::vehicles(1)->brands(5)->models(508)->miniature());
print_r(TuningApiClient::vehicles(1)->brands(5)->models(5359)->years(8163)->miniature());
print_r(TuningApiClient::vehicles(1)->brands(5)->models(5359)->years(8163)->powertrains(8165)->miniature());
```

In case of an error, the api throws a `BcConsulting\TuningApiClient\Exceptions\TuningApiException`.  This exception inherits from `\Exception` and additionally has these methods :

- `getStatusCode()` : returns the HTTP status code received
- `getData()` : returns an array with more exception specific details

```php
$e->getMessage()
$e->getCode()
$e->getStatusCode()
$e->getData()
```

## Help and docs

- [API Documentation](https://tuning-api.bcconsulting.lu/docs)

## License
[MIT](./LICENSE.md)
