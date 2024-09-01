import React, { useState } from 'react';
import Card from './Card';

const CandidateForm = ({ initialData = {}, onSubmit, formType }) => {
    const [name, setName] = useState(initialData.name || '');
    const [email, setEmail] = useState(initialData.email || '');
    const [phone, setPhone] = useState(initialData.phone || '');

    const handleSubmit = (event) => {
        event.preventDefault();
        const candidateData = { name, email, phone };
        onSubmit(candidateData);
    };

    return (
        <Card>
        <div className="candidate-form">
            <h1>{formType === 'edit' ? 'Edit Candidate' : 'Create Candidate'}</h1>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Name (required)</label>
                    <input
                        type="text"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        required
                    />
                </div>
                <div>
                    <label>Email (required)</label>
                    <input
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                    />
                </div>
                <div>
                    <label>Phone</label>
                    <input
                        type="text"
                        value={phone}
                        onChange={(e) => setPhone(e.target.value)}
                    />
                </div>
                <button type="submit">
                    {formType === 'edit' ? 'Update Candidate' : 'Create Candidate'}
                </button>
            </form>
        </div>
        </Card>
    );
};

export default CandidateForm;
