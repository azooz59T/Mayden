<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
 * The attributes that should be cast to native types.
 *
 * @var array
 */
  protected $casts = [
      'ticked' => 'boolean',
  ];
}
