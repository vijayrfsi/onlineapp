<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $updated_at
 * @property string   $name
 * @property string   $url
 * @property string   $domain
 * @property string   $middleware
 * @property string   $method
 * @property string   $action
 * @property string   $action_method
 * @property string   $action_class
 * @property DateTime $created_at
 */
class FsiRoute extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fsi_routes';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'domain', 'middleware', 'method', 'action', 'action_method', 'action_class', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int', 'name' => 'string', 'url' => 'string', 'domain' => 'string', 'middleware' => 'string', 'method' => 'string', 'action' => 'string', 'action_method' => 'string', 'action_class' => 'string', 'created_at' => 'datetime', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
