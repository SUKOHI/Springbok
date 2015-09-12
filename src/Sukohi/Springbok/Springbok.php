<?php namespace Sukohi\Springbok;

use \Carbon\Carbon;
class Springbok extends \Eloquent {

    public function __get($name) {

        if($this->hasConvertAttribute($name)) {

            $mode = $this->convert_attributes[$name];
            $value = (isset($this->attributes[$name])) ? $this->attributes[$name] : null;

            if($mode == 'date') {

                if(empty($value) || $value == '0000-00-00 00:00:00') {

                    return '';

                }

                return new Carbon($value);

            } else if($mode == 'json') {

                if(empty($value)) {

                    return [];

                }

                return json_decode($value, true);

            }

        }

        return is_callable(['parent', '__get']) ? parent::__get($name) : null;

    }

    public function __set($name, $values) {

        if($this->hasConvertAttribute($name)) {

            $mode = $this->convert_attributes[$name];

            if($mode == 'json') {

                $this->attributes[$name] = json_encode($values);
                return;

            }

        }

        return is_callable(['parent', '__set']) ? parent::__set($name, $values) : null;

    }

    private function hasConvertAttribute($name) {

        return (isset($this->convert_attributes[$name]));

    }

}