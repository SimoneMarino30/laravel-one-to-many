<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    use HasFactory;

    protected $fillable = ["title", "link", "date", "description"];

    protected function getDateAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    // protected function getImageAttribute($value) {
    //     return $value ? asset('storage/' . $value) : 'https://www.frosinonecalcio.com/wp-content/uploads/bfi_thumb/default-placeholder-38gbdutk2nbrubtodg93tqlizprlhjpd1i4m8gzrsct8ss250.png';
       
    // }

}