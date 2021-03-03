# Kuwago API Client

Use set_config function to set your API credentials from Kuwago.

## GET functions
```txt
get_product
get_products
get_stock
get_vendors
get_customers
get_costs
get_customer
```
## Example: 
```php
### Load all articles
$arr = kuwago_client::call('get_products');

### Load article by article ID
$arr = kuwago_client::call('get_product', array('pid' => '1111111') );

### Load article by article title
$arr = kuwago_client::call('get_product', array('pname' => 'my article name') );

### Load article by article number
$arr = kuwago_client::call('get_product', array('artnr' => 'P123456') );

### Stock amount history of one article
$arr = kuwago_client::call('get_stock', array('stock_pid' => '111111') );

### Stock amount history of all articles
$arr = kuwago_client::call('get_stock', array() );

### Get list of all vendors (Kreditors)
$arr = kuwago_client::call('get_vendors', array() );

### Get list of all customers
$arr = kuwago_client::call('get_customers', array() );

### Get list of all costs
$arr = kuwago_client::call('get_costs', array() );

### Get single customer by KNR
$arr = kuwago_client::call('get_customer', array('KNR' => '112233') );

### Add cost
$result = kuwago_client::call('add_cost', array(
      'co_date' => '2021-05-13', 
      'co_invnr' => '112233', 
      'co_ks_id' => '1', 
      'co_skr_nr' => '3200',      
      'co_skr_label' => 'Externe Dienstleistung',
      'co_gegenkonto' => '1200',
      'co_vendor_id' => '123456', 
      'co_description' => 'some words',
      'co_total' => '119.95') );

```
