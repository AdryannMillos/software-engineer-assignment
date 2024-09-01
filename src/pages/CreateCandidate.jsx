import React from 'react';
import { candidatesService } from '../services/apiService';
import CandidateForm from '../components/CandidateForm';
import { useNavigate } from 'react-router-dom';

const CreateCandidate = () => {
    const navigate = useNavigate();

    const handleCreate = async (candidateData) => {
        try {
            await candidatesService.create(candidateData);
            console.log('Candidate created successfully');
        } catch (error) {
            console.error('Error creating candidate:', error);
        }
        navigate('/');
    };

    return (
        <div className="create-candidate">
            <CandidateForm
                onSubmit={handleCreate}
                formType="create"
            />
        </div>
    );
};

export default CreateCandidate;
