import React from 'react';
import Card from './Card';
import Button from './Button';

const EmptyState = () => (
  <Card>
    <h2>No candidates found</h2>
    <p>Create your first candidate</p>
    <Button>Create candidate</Button>
  </Card>
);

export default EmptyState;
