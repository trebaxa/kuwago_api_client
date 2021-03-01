# kuwago_api_client

Use set_config function to set your API credentials from Kuwago.

## GET functions

get_product
get_products


## Example: 
```php
$arr = kuwago_client::call('get_products');
$arr = kuwago_client::call('get_product', array('pid' => '1111111') );
$arr = kuwago_client::call('get_product', array('pname' => 'Text article') );
$arr = kuwago_client::call('get_product', array('artnr' => 'P1223456') );

```
