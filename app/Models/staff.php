<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;

#[Fillable(['firstname', 'lastname', 'email', 'role', 'tel', 'alternative_tel', 'address', 'id_type', 'id_number','status','hire_date', 'shift_type', 'shift_start_time', 'shift_end_time'])]
#[Hidden(['hire_date'])]
class staff extends Model
{
    //
    use HasFactory, SoftDeletes;

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
        ];
    }
}
