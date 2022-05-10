<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public function report()
    {
        # Photo belongs to Report
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Models\Report');
    }
}