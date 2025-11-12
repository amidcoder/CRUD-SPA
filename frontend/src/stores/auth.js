import { defineStore } from 'pinia'
import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:8000/api'

export const useAuthStore = defineStore('auth',{
  state:()=>({ user:null, token:localStorage.getItem('token') }),
  getters:{ isAuthenticated: s => !!s.token },
  actions:{
    async login(email,password){
      const {data} = await axios.post('/login',{email,password})
      this.user=data.user; this.token=data.token
      localStorage.setItem('token',data.token)
      axios.defaults.headers.common['Authorization']=`Bearer ${data.token}`
    },
    async logout(){
      await axios.post('/logout')
      this.user=null; this.token=null
      localStorage.removeItem('token')
    }
  }
})
