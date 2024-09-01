import React from 'react';
import { candidatesService } from '../services/apiService'
import { useNavigate } from 'react-router-dom';

const DeleteConfirmationModal = ({ onClose, onDelete, id }) => {
    const navigate = useNavigate();

    const handleDelete = async () => {
        try {
        await candidatesService.delete(id);
        onDelete();
        } catch (err) {
        console.error('Error deleting candidate:', err);
        }
        navigate('/');
    };
  return (
    <div className="modal-overlay">
      <div className="modal">
        <div className="modal-header">
          <h3>Are you sure you want to delete?</h3>
          <button onClick={onClose} className="close-button">×</button>
        </div>
        <div className="modal-body">
          <p>This candidate will be permanently deleted.</p>
        </div>
        <div className="modal-footer">
          <button onClick={onClose} className="cancel-button">Cancel</button>
          <button onClick={handleDelete} className="delete-button">Delete</button>
        </div>
      </div>
    </div>
  );
};

export default DeleteConfirmationModal;
