import axios from '../mainAxios'

export const updateCartQuantity = (productId, action) => {
  return axios.patch(`/cart/items/${productId}`, {
    action
  })
}

export const addToCart = (productId, quantity = 1) => {
  return axios.post('/cart/items', {
    product_id: productId,
    quantity
  })
}

export const getCart = () => {
  return axios.get('/cart')
}

export const removeFromCart = (productId) => {
  return axios.delete(`/cart/items/${productId}`)
}