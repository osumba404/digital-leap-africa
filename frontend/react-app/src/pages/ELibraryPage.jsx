import React, { useState, useEffect } from 'react';
import apiClient from '../services/api';

// A simple helper to get an icon based on item type
const getTypeIcon = (type) => {
  switch (type.toLowerCase()) {
    case 'ebook':
      return '📖'; // Book emoji
    case 'video':
      return '▶️'; // Play button emoji
    case 'toolkit':
      return '🛠️'; // Hammer and wrench emoji
    default:
      return '📄'; // Document emoji
  }
};

const ELibraryPage = () => {
  const [items, setItems] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    apiClient.get('/elibrary')
      .then(response => {
        setItems(response.data);
        setIsLoading(false);
      })
      .catch(error => {
        console.error("Failed to fetch eLibrary items:", error);
        setIsLoading(false);
      });
  }, []);

  if (isLoading) {
    return <div className="text-center py-10">Loading eLibrary...</div>;
  }

  return (
    <div className="bg-gray-50">
      <div className="container mx-auto px-4 py-12">
        <h1 className="text-4xl font-bold text-center mb-8">eLibrary</h1>
        <div className="max-w-3xl mx-auto bg-white rounded-lg shadow-md">
          <ul className="divide-y divide-gray-200">
            {items.map(item => (
              <li key={item.id} className="p-4 flex items-center justify-between hover:bg-gray-50">
                <div className="flex items-center">
                  <span className="text-2xl mr-4">{getTypeIcon(item.type)}</span>
                  <div>
                    <p className="text-lg font-semibold text-gray-800">{item.title}</p>
                    <p className="text-sm text-gray-500">{item.type}</p>
                  </div>
                </div>
                <a href={item.file_path} target="_blank" rel="noopener noreferrer" className="bg-blue-500 text-white px-4 py-2 text-sm rounded-md hover:bg-blue-600">
                  Download
                </a>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </div>
  );
};

export default ELibraryPage;