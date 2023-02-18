<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembersTreatment extends Model
{
    use HasFactory;
    protected $fillable = ["fecha","member_id", "treatment_id"];
}