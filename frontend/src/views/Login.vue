<template>
  <el-card class="card">
    <h2>Login</h2>
    <el-form>
      <el-form-item><el-input v-model="email" placeholder="Email" /></el-form-item>
      <el-form-item><el-input type="password" v-model="password" placeholder="Password" /></el-form-item>
      <el-button type="primary" @click="login">Login</el-button>
    </el-form>
  </el-card>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '../stores/auth'
import { useRouter } from 'vue-router'

const email = ref(''); const password = ref('')
const router = useRouter(); const auth = useAuthStore()

const login = async()=>{ await auth.login(email.value,password.value); router.push('/dashboard') }
</script>

<style>.card{width:400px;margin:100px auto;}</style>
