import React, { useEffect, useState } from 'react';
import Header from '../components/Header';
import EmptyState from '../components/EmptyState';
import CandidatesTable from '../components/CandidatesTable';
import { candidatesService } from '../services/apiService';
import { useNavigate } from 'react-router-dom';

const Home = () => {
  const [candidates, setCandidates] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchCandidates = async () => {
      try {
        const response = await candidatesService.getAll();
        setCandidates(response.data.data);
      } catch (err) {
        setError('Error fetching candidates');
        console.error('Error fetching candidates:', err);
      } finally {
        setLoading(false);
      }

      navigate('/');
    };

    fetchCandidates();
  }, []);

  if (loading) return <div>Loading...</div>;
  if (error) return <div>{error}</div>;

  return (
    <div className="home">
      <Header />
      {candidates.length === 0 ? (
        <EmptyState />
      ) : (
        <CandidatesTable candidates={candidates} />
      )}
    </div>
  );
};

export default Home;
