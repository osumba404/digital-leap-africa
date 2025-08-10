import React, { createContext, useState, useContext, useEffect } from 'react';
import apiClient from '../services/api';

const AuthContext = createContext(null);

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const [token, setToken] = useState(localStorage.getItem('authToken'));

  useEffect(() => {
    if (token) {
      // If we have a token, set it on the API client for all future requests
      apiClient.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      // Fetch the user data if it's not already loaded
      apiClient.get('/user')
        .then(response => {
          setUser(response.data);
        })
        .catch(() => {
          // If token is invalid, clear it
          localStorage.removeItem('authToken');
          setToken(null);
        });
    }
  }, [token]);

  const login = (userData, authToken) => {
    localStorage.setItem('authToken', authToken);
    setToken(authToken);
    setUser(userData);
  };

  const logout = () => {
    // We'll add a backend call to invalidate the token later
    localStorage.removeItem('authToken');
    setUser(null);
    setToken(null);
    delete apiClient.defaults.headers.common['Authorization'];
  };

  return (
    <AuthContext.Provider value={{ user, token, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

// Custom hook to use the AuthContext
export const useAuth = () => {
  return useContext(AuthContext);
};