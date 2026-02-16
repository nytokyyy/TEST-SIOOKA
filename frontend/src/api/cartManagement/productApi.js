import axios from '../mainAxios'

export const getProducts = () => {
  return axios.get('/products')
}