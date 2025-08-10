import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext'; // Import useAuth

const Header = () => {
  const { user, logout } = useAuth(); // Get auth state and logout function
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate('/login'); // Redirect to login page after logout
  };

  return (
    <header className="bg-white shadow-md w-full">
      <div className="container mx-auto px-4 py-4 flex justify-between items-center">
        <Link to="/" className="text-2xl font-bold text-gray-800">
          Digital Leap Africa
        </Link>

        <nav className="hidden md:flex space-x-6 items-center">
          <Link to="/" className="text-gray-600 hover:text-blue-600">Home</Link>
          <Link to="/dashboard" className="text-gray-600 hover:text-blue-600">Dashboard</Link>
          <Link to="/courses" className="text-gray-600 hover:text-blue-600">Courses</Link>
          <a href="http://localhost:5174/projects" className="text-gray-600 hover:text-blue-600">Projects</a>
          <Link to="/elibrary" className="text-gray-600 hover:text-blue-600">eLibrary</Link>
          {user && <Link to="/profile" className="text-gray-600 hover:text-blue-600">Profile</Link>}
        </nav>

        <div className="hidden md:flex items-center space-x-4">
          {user ? (
            // If user is logged in, show their name and a logout button
            <>
              <span className="text-gray-700 font-medium">Welcome, {user.name}</span>
              <button
                onClick={handleLogout}
                className="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
              >
                Logout
              </button>
            </>
          ) : (
            // If user is logged out, show Login and Sign Up buttons
            <>
              <Link to="/login" className="text-gray-600 hover:text-blue-600 px-3 py-2">
                Login
              </Link>
              <button className="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Sign Up
              </button>
            </>
          )}
        </div>
      </div>
    </header>
  );
};

export default Header;