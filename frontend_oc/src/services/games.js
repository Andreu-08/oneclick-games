import axios from 'axios'
const API_URL = 'https://oneclick-games.onrender.com/api'

export const getGames = async () => {
  const res = await axios.get(`${API_URL}/games`)
  return res.data
}
