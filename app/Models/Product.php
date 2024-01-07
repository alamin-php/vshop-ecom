<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;
    use HasFactory;
    protected $fillable=[
    'title',
    'slug',
    'quantity',
    'description',
    'published',
    'inStock',
    'price',
    'created_by',
    'updated_by',
    'deleted_by',
    'brand_id',
    'category_id'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}