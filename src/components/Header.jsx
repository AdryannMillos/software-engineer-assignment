import React from 'react';
import Button from './Button';
import { useNavigate } from 'react-router-dom';

const Header = () => {

  const navigate = useNavigate();

  const handleNavigate = () => {
    navigate('/candidates/create');
  };

  return(
  <header className="header">
    <h2>Candidate list</h2>
    <Button onClick={handleNavigate}>Create candidate</Button>
  </header>
);
}
export default Header;
