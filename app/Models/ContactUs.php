<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PartTypeStyle
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @mixin \Eloquent
 */
class ContactUs extends Model
{
    protected $table = 'contact_us';
}