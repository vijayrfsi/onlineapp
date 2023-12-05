<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $fsi_table_id
 * @property int      $weight
 * @property int      $updated_at
 * @property int      $user_id
 * @property string   $field_name
 * @property string   $real_name
 * @property string   $field_display_name
 * @property string   $field_type_id
 * @property string   $field_id
 * @property DateTime $created_at
 */
class FsiTableField extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fsi_table_fields';

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
        'field_name', 'real_name', 'field_display_name', 'fsi_table_id', 'field_type_id', 'field_id', 'weight', 'updated_at', 'user_id', 'created_at'
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
        'id' => 'int', 'field_name' => 'string', 'real_name' => 'string', 'field_display_name' => 'string', 'fsi_table_id' => 'int', 'field_type_id' => 'string', 'field_id' => 'string', 'weight' => 'int', 'updated_at' => 'timestamp', 'user_id' => 'int', 'created_at' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at', 'created_at'
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
