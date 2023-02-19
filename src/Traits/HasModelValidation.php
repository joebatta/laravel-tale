<?php

namespace Tale\Traits;

use Tale\Exceptions\ModelValidationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

trait HasModelValidation
{

    protected static function booted(): void
    {
        static::creating(function (Model $model) {
            if (empty(self::$rules)) {
                return;
            }

            $validation = Validator::make($model->attributesToArray(), self::$rules);

            if (!$validation->passes()) {
                $errors = $validation->errors();
                throw new ModelValidationException($errors->first());
            }

            $model->setRawAttributes($validation->getData());
        });
    }
}
