<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    protected $table = 'project_translation';
    protected $fillable = [
        'project_id','key','value','version_id','language_id'
    ];
    public function project()
    {
        return $this->belongsTo('App\Projects', 'project_id');
    }
    public function version()
    {
        return $this->belongsTo('App\Version', 'version_id');
    }
    public function language()
    {
        return $this->belongsTo('App\Languages', 'language_id');
    }
}
