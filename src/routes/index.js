import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Home from '../pages/Home';
import CreateCandidate from '../pages/CreateCandidate';
import EditCandidate from '../pages/EditCandidate';
import DispositionPage from '../pages/DispositionPage';

const AppRoutes = () => (
  <Router>
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/candidates/create" element={<CreateCandidate />} />
      <Route path="/candidates/edit/:id" element={<EditCandidate />} />
      <Route path="/dispositions/:id" element={<DispositionPage />} />
    </Routes>
  </Router>
);

export default AppRoutes;
