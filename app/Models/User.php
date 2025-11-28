<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user profile associated with the user.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Get the user designs for the user.
     */
    public function designs(): HasMany
    {
        return $this->hasMany(UserDesign::class);
    }

    /**
     * Get the subscriptions for the user.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the payments for the user.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the referrals made by the user.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'referrer_user_id');
    }

    /**
     * Get the referral records where this user was referred.
     */
    public function referredBy(): HasMany
    {
        return $this->hasMany(Referral::class, 'referred_user_id');
    }

    /**
     * Get the shipping addresses for the user.
     */
    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(ShippingAddress::class);
    }

    /**
     * Get the downloads for the user.
     */
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    /**
     * Get the shared invitations for the user.
     */
    public function sharedInvitations(): HasMany
    {
        return $this->hasMany(SharedInvitation::class);
    }

    /**
     * Get the RSVP responses for the user.
     */
    public function rsvpResponses(): HasMany
    {
        return $this->hasMany(RsvpResponse::class);
    }

    /**
     * Get the print orders for the user.
     */
    public function printOrders(): HasMany
    {
        return $this->hasMany(PrintOrder::class);
    }

    /**
     * Get the RSVP settings for the user.
     */
    public function rsvpSettings(): HasMany
    {
        return $this->hasMany(RsvpSetting::class);
    }

    /**
     * Get the user customizations for the user.
     */
    public function customizations(): HasMany
    {
        return $this->hasMany(UserCustomization::class);
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        // Check if the user has an email that ends with '@admin.com' or is the specific admin user
        return str_ends_with($this->email, '@admin.com') || $this->email === 'rektech.uk@gmail.com';
    }
}