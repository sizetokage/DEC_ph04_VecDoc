<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public static function getAllOrderByUpdated_at(){
        return self::orderBy('updated_at', 'desc')->get();
    }

    public function ruleDocuments()
    {
        return $this->hasMany(Document::class);
    } 
}
