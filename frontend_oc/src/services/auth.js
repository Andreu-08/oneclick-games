import axios from 'axios'

const API_URL = import.meta.env.VITE_API_URL

// Iniciar sesión con nombre y PIN
export const login = async (nickname, pin) => {
  const response = await axios.post(`${API_URL}/auth/login`, { nickname, pin })
  return response.data
}

// Verifica si el usuario ya está registrado
export const userExists = async (nickname) => {
  try {
    await axios.get(`${API_URL}/users/register/${nickname}`)
    return true
  } catch (error) {
    // Si el servidor devuelve 404, el usuario no existe
    if (error.response && error.response.status === 404) {
      return false
    }
    throw error
  }
}

// Cerrar sesión (requiere el token)
export const logout = async (token) => {
  await axios.post(`${API_URL}/auth/logout`, {}, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
}
