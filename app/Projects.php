<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projects extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'name','version_id','status'
    ];

    public function scopeProje_var_mi($query, $kosul) {
        $count = DB::table('projects')->where($kosul);
        return $count;
    }

    public function version()
    {
        return $this->belongsTo('App\Version', 'version_id');
    }

}
