<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $fsi_menu_id
 * @property int      $parent_id
 * @property int      $weight
 * @property int      $has_children
 * @property int      $updated_at
 * @property string   $name
 * @property string   $icon_name
 * @property string   $link_text
 * @property DateTime $created_at
 */
class FsiMenuItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fsi_menu_items';

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
        'fsi_menu_id', 'parent_id', 'name', 'icon_name', 'link_text', 'weight', 'has_children', 'created_at', 'updated_at'
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
        'id' => 'int', 'fsi_menu_id' => 'int', 'parent_id' => 'int', 'name' => 'string', 'icon_name' => 'string', 'link_text' => 'string', 'weight' => 'int', 'has_children' => 'int', 'created_at' => 'datetime', 'updated_at' => 'timestamp'
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
