import axios from 'axios'
const API_URL = 'http://localhost:8000/api'

export const getGames = async () => {
  const res = await axios.get(`${API_URL}/games`)
  return res.data
}
