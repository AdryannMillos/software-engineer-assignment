import React, { useState } from 'react';
import DropdownMenu from './DropdownMenu';
import Card from './Card';

const CandidatesTable = ({ candidates }) => {
    const [showDropdown, setShowDropdown] = useState(null);

    const handleDropdownToggle = (candidateId) => {
      setShowDropdown(showDropdown === candidateId ? null : candidateId);
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        if (isNaN(date.getTime())) {
            return 'Invalid Date';
        }
        const formatter = new Intl.DateTimeFormat('en-US', {
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
        });
        return formatter.format(date);
    };

  return (
    <Card>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Disposition</th>
          <th>Hire Type</th>
          <th>Fee</th>
          <th>Candidate Created</th>
          <th>Disposition Created</th>
        </tr>
      </thead>
      <tbody>
        {candidates.map(candidate => (
          <tr key={candidate.id}>
            <td>{candidate.id}</td>
            <td>{candidate.name}</td>
            <td>{candidate.phone || '-'}</td>
            <td>
              <span className={`badge ${candidate.disposition?.disposition}`}>
                {candidate.disposition?.disposition || '-'}
              </span>
            </td>
            <td>{candidate.disposition?.hire_type || '-'}</td>
            <td>{(candidate.disposition?.currency+candidate.disposition?.fee) || '-'}</td>
            <td>{formatDate(candidate.disposition?.created_at) || '-'}</td>
            <td>{formatDate(candidate.created_at) || '-'}</td>
            <td>
              <button 
                className="action-button"
                onClick={() => handleDropdownToggle(candidate.id)}
              >
                ...
              </button>
              {showDropdown === candidate.id && <DropdownMenu deleteCandidateId={candidate.id}/>}
            </td>
          </tr>
        ))}
      </tbody>
    </table>
    </Card>
  );
};

export default CandidatesTable;
