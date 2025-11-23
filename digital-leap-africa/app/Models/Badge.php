<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Badge extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'badge_name',
        'description',
        'img_url',
    ];
    
    protected $appends = ['image_url'];
    
    /**
     * Get the badge image URL
     */
    public function getImageUrlAttribute()
    {
        if (!$this->img_url) {
            return asset('images/default-badge.svg');
        }
        
        // If already an absolute URL, return as is
        if (preg_match('/^https?:\/\//i', $this->img_url)) {
            return $this->img_url;
        }
        
        // Convert storage path to full URL
        return Storage::disk('public')->url($this->img_url);
    }
    
    /**
     * Get the users that have been awarded this badge
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'badge_user')
                    ->withPivot('awarded_at')
                    ->withTimestamps();
    }
}