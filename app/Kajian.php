<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'kajian';
    protected $fillable = [
        'nama', 'tanggal', 'deskripsi', 'waktu', 'lama', 'pembicara', 'alamat'
    ];
}
