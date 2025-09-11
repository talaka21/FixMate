<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
       use HasTranslations;
        public $translatable = ['content'];
protected $fillable = ['content',
'phone',
'facebook',
'instagram',
];
}
