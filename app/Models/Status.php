<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const OPEN = 1;
    public const IN_PROGRESS = 2;
    public const COMPLETED = 3;
    public const REJECTED = 4;

    protected $fillable = [
      'name'
    ];
}
