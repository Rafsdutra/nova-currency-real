<?php

namespace rafsd\CurrencyField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Number;



/**
 * @property string format
 */
class CurrencyField extends Number
{

    public $format;
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'currency-field';


    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->step('0.01')->displayUsing(function ($value) {
            return !is_null($value) ? number_format($this->format ?? $value, 2, ',', '.'): null;
        });
    }

    /**
     * The monetary format the field will used be displayed in.
     *
     * @param string $format
     * @return $this
     */
    public function format($format)
    {
        $this->format = $format;

        return $this;
    }
}
