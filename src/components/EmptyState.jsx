import React from 'react';
import Card from './Card';
import Button from './Button';
import { useNavigate } from 'react-router-dom';

const EmptyState = () => {
  const navigate = useNavigate();

  const handleNavigate = () => {
    navigate('/candidates/create');
  };

  return (
    <Card>
      <h2>No candidates found</h2>
      <p>Create your first candidate</p>
      <Button onClick={handleNavigate}>Create candidate</Button>
    </Card>
  );
};

export default EmptyState;
