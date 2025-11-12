<template>
  <el-card class="card">
    <h2>Register</h2>
    <el-form :model="form" :rules="rules" ref="formRef" label-position="top">
      <el-form-item label="Name" prop="name">
        <el-input v-model="form.name" placeholder="Full name" />
      </el-form-item>

      <el-form-item label="Email" prop="email">
        <el-input v-model="form.email" placeholder="Email address" />
      </el-form-item>

      <el-form-item label="Password" prop="password">
        <el-input type="password" v-model="form.password" placeholder="Password" show-password />
      </el-form-item>

      <el-form-item label="Role (Optional)">
        <el-select v-model="form.role" placeholder="Select role">
          <el-option label="User" value="user" />
          <el-option label="Admin" value="admin" />
        </el-select>
      </el-form-item>

      <el-button type="primary" @click="submit" :loading="loading">Register</el-button>
      <el-button type="text" @click="$router.push('/login')">Already have an account?</el-button>
    </el-form>
  </el-card>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { ElMessage } from 'element-plus'
import { useRouter } from 'vue-router'

const router = useRouter()
const loading = ref(false)
const formRef = ref(null)
const form = ref({
  name: '',
  email: '',
  password: '',
  role: 'user'
})

const rules = {
  name: [{ required: true, message: 'Name is required', trigger: 'blur' }],
  email: [{ required: true, message: 'Email is required', trigger: 'blur' }],
  password: [{ required: true, message: 'Password is required', trigger: 'blur' }]
}

const submit = () => {
  formRef.value.validate(async valid => {
    if (!valid) return
    loading.value = true
    try {
      await axios.post('http://localhost:8000/api/register', form.value)
      ElMessage.success('Registration successful. You can now log in.')
      router.push('/login')
    } catch (e) {
      ElMessage.error(e.response?.data?.message || 'Registration failed')
    } finally {
      loading.value = false
    }
  })
}
</script>

<style scoped>
.card {
  width: 400px;
  margin: 100px auto;
}
h2 {
  text-align: center;
  margin-bottom: 20px;
}
</style>
