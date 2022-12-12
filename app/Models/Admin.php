<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class Admin extends User
{
    use HasFactory, HasParent;
}
