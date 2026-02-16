import axios from '../mainAxios'

export const login = (data) => {
  return axios.post('/login', data)
}

export const register = (name, email, password) => {
  return axios.post('/register', {
    name,
    email,
    password
  })
}

export const logout = () => {
  return axios.post('/logout')
}

export const getUser = () => {
  return axios.get('/user')
}

export const getCookie = () => {
  return axios.get('/sanctum/csrf-cookie')
}

export const setAuthToken = (token) => {
    if(token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    } else {
        delete axios.defaults.headers.common['Authorization'];
    }
}