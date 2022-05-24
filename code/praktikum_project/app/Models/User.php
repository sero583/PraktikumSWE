<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;
use App\Models\RecentCourse;
use App\Models\FinishedLesson;

class User extends Authenticatable /*implements MustVerifyEmail*/
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rank'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'rank',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Overriding create function, so it also sends the welcome mail for new users.
     */
    public function create($data) {
        parent::create($data);

        $this->sendWelcomeMail($data["email"]);
    }

    public function recent_courses(){
        return $this->hasMany(RecentCourse::class);
    }

    public function finished_lessons(){
        return $this->hasMany(FinishedLesson::class);
    }

    // TODO: Keep methods in model class?

    /**
     * Sends password reset mail to linked mail address.
     */
    public function sendPasswordResetMail($mail = null) : void {
        // TODO: implement
        if($mail===null) $mail = $this->email;
        if($mail===null) throw new RuntimeException("Mail cannot be null");

        Log::info("Password reset for $mail has been triggered.");
    }

    public function sendWelcomeMail($mail = null) : void {
        // TODO: implement
        if($mail===null) $mail = $this->email;
        if($mail===null) throw new RuntimeException("Mail cannot be null");

        Log::info("User with $mail needs welcome mail.");
    }

    /**
     * Checks if user is admin. 
     */
    public function isAdmin() : bool {
        return $this->rank > 0;
    }

    /**
     * Checks if user has it's email verified.
     */
    public function hasItsEmailVerified() : bool {
        return $this->email_verified_at !== null;
    }
}
