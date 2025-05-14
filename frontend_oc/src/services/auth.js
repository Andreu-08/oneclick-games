import axios from 'axios'

const API_URL = 'http://localhost:8000/api'

//lamada a la api para el login 
export const login = async (nickname, pin) => {
  const response = await axios.post(`${API_URL}/login`, { nickname, pin })
  return response.data
}
