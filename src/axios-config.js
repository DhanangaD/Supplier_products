import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000', // Adjust the port as per your backend setup
  headers: {
    'Content-Type': 'application/json',
  },
});

export default axiosInstance;