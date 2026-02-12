<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
      use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_enabled',
        'order',
    ];


      public function getIconUrl(): string
    {
        if ($this->icon) {
            return asset('storage/' . $this->icon);
        }
        return asset('assets/images/logo-light.png');
    }
}
