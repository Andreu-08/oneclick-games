import axios from 'axios'

const API_URL = 'http://localhost:8000/api'

// llamada a la api para el login
export const login = async (nickname, pin) => {
  const response = await axios.post(`${API_URL}/auth/login`, { nickname, pin })
  return response.data
}

// comprobar si existe un usuario por nickname
export const userExists = async (nickname) => {
  try {
    await axios.get(`${API_URL}/users/register/${nickname}`)
    return true
  } catch (error) {
    if (error.response && error.response.status === 404) {
      return false
    }
    throw error
  }
}

export const logout = async (token) => {
  await axios.post(`${API_URL}/auth/logout`, {}, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
}