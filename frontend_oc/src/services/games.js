import axios from 'axios'

const API_URL = 'http://localhost:8000/api'

// Obtener la lista de juegos desde la API
export const getGames = async () => {
  const respuesta = await axios.get(`${API_URL}/games`)
  return respuesta.data
}


/*
  JUEGO ORDENAR PALABRAS
*/

// Obtener una palabra aleatoria desde tu backend en formato 
export const getPalabraAleatoria = async () => {
  const respuesta = await axios.get(`${API_URL}/palabra`)
  return respuesta.data.word // Devuelve solo la palabra
}

