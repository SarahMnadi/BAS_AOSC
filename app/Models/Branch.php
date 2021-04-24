<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'branch_id';
    public $incrementing = false;


    protected $fillable = [
        'branch_id', 'organization_id', 'branch_phone_number', 'branch_email', 'branch_address'
    ];

    protected $dates = ['deleted_at', 'date_of_birth'];


    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class, 'branch_id');
    }
}
