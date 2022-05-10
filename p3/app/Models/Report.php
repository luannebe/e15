<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function photos()
    {
        # Report has many Photos
        # Define a one-to-many relationship.
        return $this->hasMany('App\Models\Photo');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')
            ->withTimestamps(); # Must be added to have Eloquent update the created_at/updated_at columns in a pivot table
    }

    /**
     *  Display Boolean Value for Heritage tree as Yes/No rather than 1/0
     */
    public function getHeritageTreeAttribute($value)
    {
        if ($value=='1') {
            return 'Yes';
        } elseif ($value=='0') {
            return 'No';
        } else {
            return "Unspecified";
        }
    }
       
}