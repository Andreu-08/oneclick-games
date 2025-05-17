import axios from 'axios'

const API_URL = 'http://localhost:8000/api'

// Obtener la lista de juegos desde la API
export const getGames = async () => {
  const respuesta = await axios.get(`${API_URL}/games`)
  return respuesta.data
}
