<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'image', 'price', 'description'];

    public function search($filter = null) {
        $results = $this->where(function($query) use ($filter) {
            if(!is_null($filter)) {
                $query->where('name', 'like', "%$filter%");
            }
        })->paginate(20);
        return $results;
    }
}
