<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Customer extends Model
{
    use HasFactory, LaravelVueDatatableTrait;

    protected $fillable         = [
        'email',
        'phone_number',
        'first_name',
        'last_name',
    ];

    protected $dataTableColumns = [
        'id'           => [
            'searchable' => false,
        ],
        'phone_number' => [
            'searchable' => true,
        ],
        'email'        => [
            'searchable' => true,
        ],
        'first_name'   => [
            'searchable' => true,
        ],
        'last_name'    => [
            'searchable' => true,
        ],
    ];
}
