import apiClient from './api';

// Example function for logging a user in
export const login = async (credentials) => {
  try {
    // A real request might use Laravel Sanctum's CSRF cookie
    // await apiClient.get('/sanctum/csrf-cookie');
    
    // Make the post request to the login endpoint
    const response = await apiClient.post('/auth/login', credentials);
    return response.data;
  } catch (error) {
    // It's good practice to throw the error so the component can handle it
    throw error;
  }
};

// Example function for registering a new user
export const register = async (userData) => {
  try {
    const response = await apiClient.post('/auth/register', userData);
    return response.data;
  } catch (error) {
    throw error;
  }
};

// Example function for logging a user out
export const logout = async () => {
  try {
    const response = await apiClient.post('/auth/logout');
    return response.data;
  } catch (error) {
    throw error;
  }
};