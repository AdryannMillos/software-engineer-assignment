import React from 'react';

const Button = ({ children, onClick }) => (
  <button className="btn btn-primary" onClick={onClick}>
    {children}
  </button>
);

export default Button;
