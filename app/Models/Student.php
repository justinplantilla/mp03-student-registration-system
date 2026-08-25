<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'mobile_number',
        'gender',
        'date_of_birth',
        'program',
        'year_level',
        'address',
        'profile_picture',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the student's full name.
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} " . ($this->middle_name ? "{$this->middle_name} " : '') . $this->last_name);
    }

    /**
     * Get the student's full name with middle initial.
     */
    public function getFormalNameAttribute(): string
    {
        $mi = $this->middle_name ? strtoupper(substr($this->middle_name, 0, 1)) . '. ' : '';
        return "{$this->last_name}, {$this->first_name} {$mi}";
    }

    /**
     * Get the public URL for the profile picture.
     */
    public function getProfilePictureUrlAttribute(): string
    {
        if ($this->profile_picture && file_exists(public_path('storage/' . $this->profile_picture))) {
            return asset('storage/' . $this->profile_picture);
        }

        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&background=0D8ABC&color=fff&size=256';
    }

    /**
     * Get formatted date of birth.
     */
    public function getFormattedDobAttribute(): string
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->format('F j, Y') : 'N/A';
    }

    /**
     * Calculate student age dynamically.
     */
    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }
}

