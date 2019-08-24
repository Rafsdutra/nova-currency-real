# nova-currency-real
Package para formatação de campos monetários (BRL) no Laravel Nova.

## Instalação

Para instalar, execute o seguinte comando:
`composer require rafsd/currency-field`

## Utilização
Em seu resource, utilize:
```php
use Market\CurrencyField\CurrencyField;
              .......
              
CurrencyField::make('Field do seu Resource')
 
```
