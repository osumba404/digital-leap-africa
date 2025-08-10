import React, { useState, useEffect } from 'react';
import apiClient from '../services/api';
import { Link } from 'react-router-dom';

const CoursesPage = () => {
  const [courses, setCourses] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    apiClient.get('/courses')
      .then(response => {
        setCourses(response.data);
        setIsLoading(false);
      })
      .catch(error => {
        console.error("Failed to fetch courses:", error);
        setIsLoading(false);
      });
  }, []); // The empty array ensures this effect runs only once on mount

  if (isLoading) {
    return <div className="text-center py-10">Loading courses...</div>;
  }

    return (
    <div className="bg-gray-50">
      <div className="container mx-auto px-4 py-12">
        <h1 className="text-4xl font-bold text-center mb-8">Our Courses</h1>
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {courses.map(course => (
            // 1. Wrap the entire card in a Link component
            <Link to={`/courses/${course.id}`} key={course.id} className="block h-full">
              <div className="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 h-full flex flex-col">
                <div className="p-6 flex-grow">
                  <h2 className="text-2xl font-bold mb-2">{course.title}</h2>
                  <p className="text-gray-600 mb-4">{course.description}</p>
                </div>
                <div className="p-6 pt-0 flex justify-between items-center">
                  <span className={`px-3 py-1 text-sm font-semibold rounded-full ${
                    course.is_free ? 'bg-green-200 text-green-800' : 'bg-blue-200 text-blue-800'
                  }`}>
                    {course.is_free ? 'Free' : 'Premium'}
                  </span>
                  {/* 2. Change the <a> tag to a <span> */}
                  <span className="text-blue-600 font-semibold">
                    Learn More &rarr;
                  </span>
                </div>
              </div>
            </Link>
          ))}
        </div>
      </div>
    </div>
  );
};

export default CoursesPage;