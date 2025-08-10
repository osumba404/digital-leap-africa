import React from 'react';
import { BrowserRouter as Router, Routes, Route, Outlet } from 'react-router-dom';

// Import Components
import Header from './components/common/Header';
import Footer from './components/common/Footer';
import ProtectedRoute from './components/common/ProtectedRoute';

// Import Pages
import Homepage from './pages/Homepage';
import Dashboard from './pages/Dashboard';
import LoginPage from './pages/LoginPage';
import ProfilePage from './pages/ProfilePage';
import CoursesPage from './pages/CoursesPage'; 
import CourseDetailPage from './pages/CourseDetailPage'; 
import ELibraryPage from './pages/ELibraryPage';

// Import the AuthProvider
import { AuthProvider } from './context/AuthContext';

const MainLayout = () => {
  return (
    <div className="flex flex-col min-h-screen">
      <Header />
      <main className="flex-grow">
        <Outlet />
      </main>
      <Footer />
    </div>
  );
};

function App() {
  return (
    <AuthProvider>
      <Router>
        <Routes>
          {/* Routes with Header and Footer */}
          <Route path="/" element={<MainLayout />}>
            {/* Public Routes */}
            <Route index element={<Homepage />} />
            <Route path="dashboard" element={<Dashboard />} />
            <Route path="courses" element={<CoursesPage />} /> 
            <Route path="courses/:id" element={<CourseDetailPage />} />
            <Route path="elibrary" element={<ELibraryPage />} />

            {/* Protected Routes */}
            <Route element={<ProtectedRoute />}>
              <Route path="profile" element={<ProfilePage />} />
            </Route>
          </Route>
          
          {/* Standalone Route without Layout */}
          <Route path="/login" element={<LoginPage />} />
        </Routes>
      </Router>
    </AuthProvider>
  );
}

export default App;