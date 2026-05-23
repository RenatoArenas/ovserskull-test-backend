<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Category extends Model
{
    use HasUuids, SoftDeletes, LogsActivity;

    protected $table = 'categories';

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
