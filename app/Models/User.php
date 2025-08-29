<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // This should match your database column names
    protected $fillable = [
        'username',
        'password_hash',
        'user_role',
        'phone_number', // ← Add this
        'associated_id',
        'status_id',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',    // Common for Auth
    ];

    /**
     * Automatically hash password on set
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relationships
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function associatedDoctor()
    {
        return $this->belongsTo(Doctor::class, 'associated_id');
    }

    public function associatedPatient()
    {
        return $this->belongsTo(Patient::class, 'associated_id');
    }
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
