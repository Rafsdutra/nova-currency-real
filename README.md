# nova-currency-real
Package para formatação de campos monetários (BRL) no Laravel Nova.

## Instalação

Para instalar, execute o seguinte comando:
`composer require rafsd/currency-field`

## Utilização
Em seu resource, utilize:
```php
use rafsd\CurrencyField\CurrencyField;
              .......
              
CurrencyField::make('Field Monetário', 'monetary_field')
 
```
