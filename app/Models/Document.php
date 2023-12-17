<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rule;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'path',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rule(){
        return $this->belongsTo(Rule::class);
    }

    // version変更履歴管理用のruleとdocumentの中間テーブルとの連携
    public function rules()
    {
        return $this->belongsToMany(Document::class)->withTimestamps();
    }

}
