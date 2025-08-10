import React from 'react';
import { Link } from 'react-router-dom';

const Header = () => {
  return (
    <header className="bg-white shadow-md w-full">
      <div className="container mx-auto px-4 py-4 flex justify-between items-center">
        {/* Site Logo/Title */}
        <Link to="/" className="text-2xl font-bold text-gray-800">
          Digital Leap Africa
        </Link>

        {/* Navigation Links */}
        <nav className="hidden md:flex space-x-6">
          <Link to="/" className="text-gray-600 hover:text-blue-600">Home</Link>
          <Link to="/dashboard" className="text-gray-600 hover:text-blue-600">Dashboard</Link>
          <a href="#" className="text-gray-600 hover:text-blue-600">Courses</a>
          <a href="#" className="text-gray-600 hover:text-blue-600">Events</a>
          <a href="#" className="text-gray-600 hover:text-blue-600">Jobs</a>
        </nav>

        {/* Call to Action Buttons */}
        <div className="hidden md:flex items-center space-x-2">
          <Link to="/login" className="text-gray-600 hover:text-blue-600 px-4 py-2">
            Login
          </Link>
          <Link to="/signup" className="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Sign Up
          </Link>
        </div>
      </div>
    </header>
  );
};

export default Header;