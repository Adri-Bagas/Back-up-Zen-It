<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory,Sluggable,InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $append = ['gallery'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Tb_productcate::class);
    }

    public function getGalleryAttribute()
    {
        return $this->getMedia('gallery');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
