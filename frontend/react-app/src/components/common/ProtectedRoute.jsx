import React from 'react';
import { Navigate, Outlet } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

const ProtectedRoute = () => {
  const { user, token } = useAuth();

  // A simple check for the token is often sufficient to start.
  // The AuthContext already tries to fetch the user if a token exists.
  if (!token) {
    return <Navigate to="/login" replace />;
  }

  // If there is a token, render the child route component (e.g., ProfilePage).
  return <Outlet />;
};

export default ProtectedRoute;