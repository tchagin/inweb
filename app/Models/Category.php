<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'shortDesc', 'description', 'thumbnail'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('thumbnail')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/categories/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->thumbnail) {
            return asset("no-image.png");
        }
//        return asset("storage/app/uploads/{$this->thumbnail}");
        return Storage::url($this->thumbnail);
    }
}
