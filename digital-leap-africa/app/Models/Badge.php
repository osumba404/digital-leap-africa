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