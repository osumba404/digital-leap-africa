 import React, { useState, useEffect } from 'react';
    import { useParams } from 'react-router-dom';
    import apiClient from '../services/api';

    const CourseDetailPage = () => {
      const { id } = useParams(); // Get the 'id' from the URL
      const [course, setCourse] = useState(null);
      const [isLoading, setIsLoading] = useState(true);

      useEffect(() => {
        apiClient.get(`/courses/${id}`)
          .then(response => {
            setCourse(response.data);
            setIsLoading(false);
          })
          .catch(error => {
            console.error("Failed to fetch course details:", error);
            setIsLoading(false);
          });
      }, [id]); // Re-run the effect if the id changes

      if (isLoading) {
        return <div className="text-center py-10">Loading course details...</div>;
      }

      if (!course) {
        return <div className="text-center py-10">Course not found.</div>;
      }

      return (
        <div className="container mx-auto px-4 py-12">
          <div className="bg-white p-8 rounded-lg shadow-lg">
            <span className={`mb-4 inline-block px-3 py-1 text-sm font-semibold rounded-full ${
              course.is_free ? 'bg-green-200 text-green-800' : 'bg-blue-200 text-blue-800'
            }`}>
              {course.is_free ? 'Free Course' : 'Premium Course'}
            </span>
            <h1 className="text-4xl font-bold mb-4">{course.title}</h1>
            <p className="text-lg text-gray-700 mb-6">{course.description}</p>
            <button className="bg-blue-600 text-white px-8 py-3 rounded-md font-semibold hover:bg-blue-700">
              Enroll Now
            </button>
          </div>
        </div>
      );
    };

    export default CourseDetailPage;