import axios from 'axios';

// Get the backend API URL from the environment variables we set up earlier
const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

// Create a new Axios instance with a custom configuration
const apiClient = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  // withCredentials: true, // Use this if you need to handle cookies for session-based auth
});

/*
 * INTERCEPTORS (Optional but Recommended)
 * Interceptors allow you to run code before a request is sent or after a response is received.
 * For example, you can automatically attach an auth token to every request.
 */
apiClient.interceptors.request.use(
  (config) => {
    // const token = localStorage.getItem('authToken');
    // if (token) {
    //   config.headers['Authorization'] = `Bearer ${token}`;
    // }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default apiClient;