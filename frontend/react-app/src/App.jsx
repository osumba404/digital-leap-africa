import React from 'react';
import { BrowserRouter as Router, Routes, Route, Outlet } from 'react-router-dom';
import Header from './components/common/Header';
import Footer from './components/common/Footer';
import Homepage from './pages/Homepage';
import Dashboard from './pages/Dashboard';
import LoginPage from './pages/LoginPage'; // <-- IMPORT

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
    <Router>
      <Routes>
        {/* Routes with Header and Footer */}
        <Route path="/" element={<MainLayout />}>
          <Route index element={<Homepage />} />
          <Route path="dashboard" element={<Dashboard />} />
        </Route>
        
        {/* Route without Header and Footer */}
        <Route path="/login" element={<LoginPage />} /> {/* <-- ADD THIS ROUTE */}
      </Routes>
    </Router>
  );
}

export default App;