import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api';

const candidatesService = {
  getAll: () => axios.get(`${API_URL}/candidates`),
  getById: (id) => axios.get(`${API_URL}/candidates/${id}`),
  create: (data) => axios.post(`${API_URL}/candidates`, data),
  update: (id, data) => axios.put(`${API_URL}/candidates/${id}`, data),
  delete: (id) => axios.delete(`${API_URL}/candidates/${id}`),
};

const dispositionsService = {
  getAll: () => axios.get(`${API_URL}/dispositions`),
  getById: (id) => axios.get(`${API_URL}/dispositions/${id}`),
  create: (data) => axios.post(`${API_URL}/dispositions`, data),
  update: (id, data) => axios.put(`${API_URL}/dispositions/${id}`, data),
  delete: (id) => axios.delete(`${API_URL}/dispositions/${id}`),
};

export { candidatesService, dispositionsService };
