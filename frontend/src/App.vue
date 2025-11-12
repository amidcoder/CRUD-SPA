<template>
  <el-config-provider :locale="locale" :size="size">
    <div class="app-wrapper">
      <el-container class="main-container">
        <el-header v-if="auth.isAuthenticated">
          <div class="logo-area" @click="$router.push('/')">
            <span>MyApp</span>
          </div>

          <div class="spacer"></div>

          <div class="nav">
            <el-button
              v-if="auth.user?.role === 'admin'"
              type="text"
              @click="$router.push('/users')"
            >
              Users
            </el-button>

            <el-button type="text" @click="$router.push('/dashboard')">
              Dashboard
            </el-button>

            <el-button type="text" @click="logout">Logout</el-button>
          </div>
        </el-header>

        <el-main>
          <router-view v-slot="{ Component }">
            <transition name="fade" mode="out-in">
              <component :is="Component" />
            </transition>
          </router-view>
        </el-main>

        <el-footer v-if="auth.isAuthenticated">
          <p>© {{ new Date().getFullYear() }} MyApp. All rights reserved.</p>
        </el-footer>
      </el-container>
    </div>
  </el-config-provider>
</template>

<script setup>
import { computed } from 'vue'
import { useAuthStore } from './stores/auth'
import { ElMessage } from 'element-plus'
import zhCn from 'element-plus/es/locale/lang/en'
import { useRouter } from 'vue-router'

const router = useRouter()
const locale = zhCn
const size = 'default'
const auth = useAuthStore()

const logout = async () => {
  try {
    await auth.logout()
    ElMessage.success('Logged out successfully')
    router.push('/login')
  } catch {
    ElMessage.error('Logout failed')
  }
}
</script>

<style scoped>
.app-wrapper {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: #f8f9fb;
}

.main-container {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.el-header {
  background-color: #32475b;
  color: #fff;
  display: flex;
  align-items: center;
  padding: 0 20px;
}

.logo-area {
  font-weight: 600;
  font-size: 1.2rem;
  cursor: pointer;
  color: #fff;
}

.nav {
  display: flex;
  gap: 15px;
}

.spacer {
  flex: 1;
}

.el-main {
  flex: 1;
  padding: 30px;
}

.el-footer {
  text-align: center;
  font-size: 0.9rem;
  color: #777;
  padding: 15px 0;
  background: #f1f2f4;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
