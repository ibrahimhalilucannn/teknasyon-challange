<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Version extends Model
{
    protected $table = 'version';
    protected $fillable = [
        'name','status'
    ];

    public function scopeVersion_var_mi($query, $kosul) {
        $count = DB::table('version')->where($kosul);
        return $count;
    }
}
