<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        /**
         * About image :
         * 
         * Strategy is to store relative path in database
         * Images will be uploaded in the storage folder, in disk
         * It seems simple for now than to manage base64 encoded images
         */
        'image',
        /**
         * About description :
         * 
         * We have multiple choices:
         * - Either store a simple string, with newline chars to divide sentences
         * - Either store a string which actually is html, from like a Quill component in the front end
         * - Either store an "array" of string, where each element is a sentence
         * 
         * I'll choose array of string for conveniance and to not have to parse inconsistently eofs
         */
        'description'
    ];

    public function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }
}
