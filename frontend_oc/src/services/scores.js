import axios from 'axios'

const API_URL = 'http://localhost:8000/api'

export const getGlobalRanking = async () => {
  const token = localStorage.getItem('token') // o donde lo tengas guardado
  const response = await axios.get(`${API_URL}/scores/top`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  return response.data.ranking
}

export const getMyGlobalRanking = async () => {
  const token = localStorage.getItem('token')
  const res = await axios.get(`${API_URL}/scores/global/me`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  return res.data
}
