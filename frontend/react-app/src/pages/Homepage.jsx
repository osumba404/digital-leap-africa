import React from 'react';

const Homepage = () => {
  return (
    <div className="container mx-auto px-4 py-16 text-center">
      <h1 className="text-4xl md:text-5xl font-bold text-gray-800">
        Empowering African Youth Through Technology
      </h1>
      <p className="mt-4 text-lg text-gray-600">
        Your gateway to courses, projects, and a vibrant tech community.
      </p>
      <div className="mt-8">
        <button className="bg-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700">
          Explore Courses
        </button>
      </div>
    </div>
  );
};

export default Homepage;