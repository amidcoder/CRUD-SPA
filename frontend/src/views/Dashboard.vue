<template>
  <div class="dashboard">
    <el-card>
      <div class="user-info">
        <h2>Welcome, {{ auth.user?.name }}</h2>
        <p>Email: {{ auth.user?.email }}</p>
        <p>Role: <strong>{{ auth.user?.role }}</strong></p>
        <el-button type="danger" size="small" @click="logout">Logout</el-button>
      </div>
    </el-card>

    <el-divider />

    <el-card>
      <h3>Create New Post</h3>
      <el-form :inline="true" :model="post">
        <el-form-item>
          <el-input v-model="post.title" placeholder="Post title" />
        </el-form-item>
        <el-form-item>
          <el-input v-model="post.content" placeholder="Post content" />
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="createPost">Add</el-button>
        </el-form-item>
      </el-form>
    </el-card>

    <el-divider />

    <el-card>
      <h3>All Posts</h3>
      <el-table :data="posts" style="width: 100%">
        <el-table-column prop="id" label="ID" width="60" />
        <el-table-column prop="title" label="Title" />
        <el-table-column prop="content" label="Content" />
        <el-table-column label="Actions" width="120">
          <template #default="scope">
            <el-button type="danger" size="small" @click="deletePost(scope.row.id)">Delete</el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { ElMessage } from 'element-plus'
import { useAuthStore } from '../stores/auth'
import { useRouter } from 'vue-router'

const router = useRouter()
const auth = useAuthStore()
const posts = ref([])
const post = ref({ title: '', content: '' })

axios.defaults.headers.common['Authorization'] = `Bearer ${auth.token}`

const fetchPosts = async () => {
  try {
    const { data } = await axios.get('http://localhost:8000/api/posts')
    posts.value = data
  } catch {
    ElMessage.error('Failed to load posts')
  }
}

const createPost = async () => {
  if (!post.value.title || !post.value.content)
    return ElMessage.warning('Enter title and content')
  try {
    const { data } = await axios.post('http://localhost:8000/api/posts', post.value)
    posts.value.push(data)
    post.value = { title: '', content: '' }
    ElMessage.success('Post added')
  } catch {
    ElMessage.error('Failed to add post')
  }
}

const deletePost = async id => {
  try {
    await axios.delete(`http://localhost:8000/api/posts/${id}`)
    posts.value = posts.value.filter(p => p.id !== id)
    ElMessage.success('Post deleted')
  } catch {
    ElMessage.error('Delete failed')
  }
}

const logout = async () => {
  await auth.logout()
  router.push('/login')
}

onMounted(fetchPosts)
</script>

<style scoped>
.dashboard {
  max-width: 900px;
  margin: 40px auto;
}
.user-info {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
</style>
