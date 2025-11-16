<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        
        // If it's already a full path starting with /storage/, return as URL
        if (str_starts_with($this->img_url, '/storage/')) {
            return url($this->img_url);
        }
        
        // Default: assume it's just a filename in badges directory
        return url('/storage/badges/' . $this->img_url);
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