<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'ebook_name',
        'ebook_file',
        'ebook_ver',
        'status',
        'ebook_cover', 
    ];}
