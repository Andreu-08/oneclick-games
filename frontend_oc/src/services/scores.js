import axios from 'axios'

const API_URL = 'http://localhost:8000/api'

/*
  LLAMADAS A LA API PARA ALMACENAR PUNTUACIONES
*/
export const guardarPuntuacion = async (gameId, score, token) => {
  const respuesta = await axios.post(
    'http://localhost:8000/api/scores',
    {
      game_id: gameId,
      score: score
    },
    {
      headers: {
        Authorization: `Bearer ${token}`
      }
    }
  )
  return respuesta.data
}

/*
  LLAMADAS A LA API PARA LOS RANKINGS
*/

// 🔹 Devuelve el ranking global con los 10 usuarios con mayor puntuación total
export const getGlobalRanking = async () => {
  const token = localStorage.getItem('token')
  const response = await axios.get(`${API_URL}/scores/top`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  return response.data.ranking // [{ id, nickname, total_score }]
}

// 🔹 Devuelve la puntuación total y posición del usuario en el ranking global
export const getMyGlobalRanking = async () => {
  const token = localStorage.getItem('token')
  const res = await axios.get(`${API_URL}/scores/global/me`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  return res.data // { id, nickname, total_score, position }
}

// 🔹 Devuelve el top 10 de un juego concreto
export const getGameTopScores = async (gameId) => {
  const token = localStorage.getItem('token')
  const res = await axios.get(`${API_URL}/scores/game/${gameId}/top`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  return res.data.ranking
}

// 🔹 Devuelve la puntuación total del usuario logueado para un juego concreto
export const getMyGameRanking = async (gameId) => {
  const token = localStorage.getItem('token')
  const res = await axios.get(`${API_URL}/scores/game/${gameId}/me`, {
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
  return res.data // { id, nickname, total_score }
}
