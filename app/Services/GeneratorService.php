<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Model;

class GeneratorService
{
    public static function uniqueFieldValue(Model $model, string $value, string $field = 'username')
    {
        if($model->where($field, $value)->exists()) {
            $explodedValue = explode(".", $value);
            $oldExt = $explodedValue[count($explodedValue)-1];
            
            if(is_numeric($oldExt)) {
                $value = str_replace('.' . $oldExt, '', $value) . '.' . ($oldExt+1);
            } else {
                $value .= ".1";
            }

            static::generateUniqueFieldValue($model, $value, $field);
        } else {
            return $value;
        }
    }
}
