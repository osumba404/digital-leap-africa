import React, { useState, useEffect } from 'react';
import { useAuth } from '../context/AuthContext';
import apiClient from '../services/api';

const ProfilePage = () => {
  const { user } = useAuth();
  const [stats, setStats] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    if (user) {
      // Corrected API endpoint to match your routes/api.php file
      apiClient.get('/profile/gamification-stats') 
        .then(response => {
          setStats(response.data);
          setIsLoading(false);
        })
        .catch(error => {
          console.error("Failed to fetch gamification stats:", error);
          setIsLoading(false);
        });
    }
  }, [user]);

  if (!user || isLoading) {
    return (
      <div className="container mx-auto px-4 py-8 text-center">
        <p>Loading profile...</p>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 className="text-3xl font-bold mb-4">User Profile</h1>
        <div className="space-y-3">
          <p><strong>Name:</strong> {user.name}</p>
          <p><strong>Email:</strong> {user.email}</p>
          <p><strong>Role:</strong> <span className="px-2 py-1 text-sm font-semibold text-white bg-green-600 rounded-full">{user.role}</span></p>
        </div>

        <div className="mt-6 border-t pt-6">
          <h2 className="text-2xl font-bold mb-3">Your Stats</h2>
          {stats ? (
            <>
              <p className="text-lg"><strong>Total Points:</strong> {stats.total_points}</p>
              <h3 className="text-xl font-semibold mt-4">Badges Earned:</h3>
              {stats.badges.length > 0 ? (
                <ul className="list-disc list-inside mt-2">
                  {stats.badges.map(badge => (
                    <li key={badge.id}>{badge.badge_type}: <span className="text-gray-600">{badge.description}</span></li>
                  ))}
                </ul>
              ) : (
                <p className="text-gray-500">No badges earned yet. Keep going!</p>
              )}
            </>
          ) : (
            <p>Loading stats...</p>
          )}
        </div>
      </div>
    </div>
  );
};

export default ProfilePage;