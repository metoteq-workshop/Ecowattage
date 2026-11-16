<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'email',
    'organization',
    'inquiry_type',
    'subject',
    'message',
    'status',
    'admin_notes',
])]
class ContactSubmission extends Model {}
