<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Array_;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'client_name', 'summary', 'cover_image', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public static function generateSlug($string)
    {
        $slug = Str::slug($string, '-');
        $original_slug = $slug;
        $c = 1;
        $exist = Project::where('slug', $slug)->first();
        while ($exist) {
            $slug = $original_slug . '-' . $c;
            $exist = Project::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')->orWhere('summary', 'like', '%' . request('search') . '%')->orWhere('client_name', 'like', '%' . request('search') . '%');
        }


    }
}
