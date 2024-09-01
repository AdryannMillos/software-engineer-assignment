import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { candidatesService } from '../services/apiService';
import CandidateForm from '../components/CandidateForm';
import { useNavigate } from 'react-router-dom';

const EditCandidate = () => {
    const { id } = useParams();
    const [candidateData, setCandidateData] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const fetchCandidate = async () => {
            try {
                const response = await candidatesService.getById(id);
                setCandidateData(response.data.data);
            } catch (error) {
                setError('Error fetching candidate data');
                console.error('Error fetching candidate data:', error);
            } finally {
                setLoading(false);
                
            }
        };

        fetchCandidate();
    }, [id]);

    const handleUpdate = async (updatedData) => {
        try {
            await candidatesService.update(id, updatedData);
            console.log('Candidate updated successfully');
            navigate('/');
        } catch (error) {
            console.error('Error updating candidate:', error);
        }
    };

    if (loading) return <div>Loading...</div>;
    if (error) return <div>{error}</div>;

    return (
        <div className="edit-candidate">
            {candidateData && (
                <CandidateForm
                    initialData={candidateData}
                    onSubmit={handleUpdate}
                    formType="edit"
                />
            )}
        </div>
    );
};

export default EditCandidate;
