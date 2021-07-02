<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Books extends Model
{
    use HasFactory;
    protected $fillable = [
        'file',
        'price',
        'name',
        'quantity',
        'description',
        'author'   
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getJWTIdentifier() {
    //     return $this->getKey();
    // }

    // public function getJWTCustomClaims() {
    //     return [];
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function getUrlAttribute()
    // {
    //     return Storage::disk('s3')->url($this->image);
    // }
}
