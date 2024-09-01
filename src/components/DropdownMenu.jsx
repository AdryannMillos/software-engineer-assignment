import React, { useState } from 'react';
import DeleteConfirmationModal from './DeleteConfirmationModal';
import { useNavigate } from 'react-router-dom';

const DropdownMenu = ({ deleteCandidateId }) => {
    const [showModal, setShowModal] = useState(false);

    const handleDelete = () => {
        setShowModal(true);
    };

    const handleConfirmDelete = () => {
        setShowModal(false);
        
    };
    const navigate = useNavigate();

    const handleNavigate = (url) => {
      navigate(url);
    };

    return (
        <div className="dropdown-menu">
            <ul>
                <li  onClick={() => handleNavigate(`/candidates/edit/${deleteCandidateId}`)}>Edit</li>
                <li onClick={() => handleNavigate(`/dispositions/${deleteCandidateId}`)}>Set disposition</li>
                <li onClick={handleDelete}>Delete</li>
            </ul>
            {showModal && (
                <DeleteConfirmationModal
                    onClose={() => setShowModal(false)}
                    id={deleteCandidateId}
                    onDelete={handleConfirmDelete}
                />
            )}
        </div>
    );
};

export default DropdownMenu;
