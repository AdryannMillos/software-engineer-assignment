import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { candidatesService, dispositionsService } from '../services/apiService';
import Card from '../components/Card';

const DispositionPage = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [disposition, setDisposition] = useState(null);
    const [formData, setFormData] = useState({
        disposition: '',
        hire_type: '',
        fee: '',
        currency: 'USD',
        rejection_reason: '',
        candidate_id: id
    });

    useEffect(() => {
        const fetchDisposition = async () => {
            try {
                const response = await dispositionsService.getById(id);
                setDisposition(response.data.data.disposition);
                setFormData({
                    ...formData,
                    ...response.data.data,
                    candidate_id: id // Ensure candidate_id is set
                });
            } catch (error) {
                console.error("Error fetching disposition:", error);
            }
        };

        if (id) {
            fetchDisposition();
        }
    }, [id]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (disposition) {
                await dispositionsService.update(id, formData);
            } else {
                await dispositionsService.create(formData);
            }
            navigate('/');
        } catch (error) {
            console.error("Error saving disposition:", error);
        }
    };

    return (
        <Card>
        <div className="card candidate-form">
            <h1>Set Disposition</h1>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Would you like to mark this candidate as hired or rejected?*</label>
                    <div>
                        <label>
                            <input
                                type="radio"
                                name="disposition"
                                value="hired"
                                checked={formData.disposition === 'hired'}
                                onChange={handleChange}
                            />
                            Hired
                        </label>
                        <label>
                            <input
                                type="radio"
                                name="disposition"
                                value="rejected"
                                checked={formData.disposition === 'rejected'}
                                onChange={handleChange}
                            />
                            Rejected
                        </label>
                    </div>
                </div>

                <div>
                    <label>Is the candidate being hired internally or externally?</label>
                    <div>
                        <label>
                            <input
                                type="radio"
                                name="hire_type"
                                value="internal"
                                checked={formData.hire_type === 'internal'}
                                onChange={handleChange}
                            />
                            Internal
                        </label>
                        <label>
                            <input
                                type="radio"
                                name="hire_type"
                                value="external"
                                checked={formData.hire_type === 'external'}
                                onChange={handleChange}
                            />
                            External
                        </label>
                    </div>
                </div>

                <div>
                    <label>Placement fee (optional)</label>
                    <div style={{ display: 'flex', alignItems: 'center' }}>
                        <input
                            type="number"
                            step="0.01"
                            name="fee"
                            value={formData.fee}
                            onChange={handleChange}
                            style={{ marginRight: '1rem' }}
                        />
                        <select
                            name="currency"
                            value={formData.currency}
                            onChange={handleChange}
                        >
                            <option value="USD">USD</option>
                            <option value="EU">EU</option>
                            <option value="RS">RS</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label>What is the reason for rejection?</label>
                    <select
                        name="rejection_reason"
                        value={formData.rejection_reason}
                        onChange={handleChange}
                    >
                        <option value="">Select a reason</option>
                        <option value="Did not have desired education">Did not have desired education</option>
                        <option value="Did not meet overall qualifications">Did not meet overall qualifications</option>
                        <option value="Misrepresented qualifications">Misrepresented qualifications</option>
                        <option value="More qualified job candidate selected">More qualified job candidate selected</option>
                        <option value="Did not fit company culture">Did not fit company culture</option>
                        <option value="Incomplete job application">Incomplete job application</option>
                        <option value="No show for interview">No show for interview</option>
                        <option value="Did not have desired experience">Did not have desired experience</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <button type="submit" className="btn-primary">
                    {disposition ? 'Update Disposition' : 'Create Disposition'}
                </button>
            </form>
        </div>
        </Card>
    );
};

export default DispositionPage;
