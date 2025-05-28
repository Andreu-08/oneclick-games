import axios from 'axios'

const API_URL = import.meta.env.VITE_API_URL
const authHeader = () => ({
  headers: {
    Authorization: `Bearer ${localStorage.getItem('token')}`
  }
})

/*
  🔸 Guardar puntuación de un juego
  Solo se guardan game_id y score por ahora.
*/
export const guardarPuntuacion = async (gameId, score) => {
  const response = await axios.post(
    `${API_URL}/scores`,
    {
      game_id: gameId,
      score: score
      // duration y meta quedan disponibles para el futuro
    },
    authHeader()
  )
  return response.data // { message, score }
}

/*
  🔹 Obtener ranking global (top 10 por puntuación total)
*/
export const getGlobalRanking = async () => {
  const response = await axios.get(`${API_URL}/scores/top`, authHeader())
  return response.data.ranking // [{ id, nickname, total_score }]
}

/*
  🔹 Obtener posición y total del usuario logueado en ranking global
*/
export const getMyGlobalRanking = async () => {
  const response = await axios.get(`${API_URL}/scores/global/me`, authHeader())
  return response.data // { id, nickname, total_score, position }
}

/*
  🔹 Obtener top 10 de un juego específico
*/
export const getGameTopScores = async (gameId) => {
  const response = await axios.get(`${API_URL}/scores/game/${gameId}/top`, authHeader())
  return response.data.ranking
}

/*
  🔹 Obtener puntuación total del usuario en un juego concreto
*/
export const getMyGameRanking = async (gameId) => {
  const response = await axios.get(`${API_URL}/scores/game/${gameId}/me`, authHeader())
  return response.data // { id, nickname, total_score }
}
