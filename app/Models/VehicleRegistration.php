<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRegistration extends Model
{
    use HasFactory;
    protected $fillable = ['ownerIdentityNumber', 'ownerDateOfBirthHijri', 'ownerDateOfBirthGregorian','sequenceNumber','plateLetterRight','plateLetterMiddle','plateLetterLeft','plateNumber','plateType'];
}
