<template>
  <v-container class="fill-height d-flex justify-center align-center">
    <v-card class="pa-6" max-width="400">
      <v-card-title class="text-h5 text-center">{{ isLogin ? 'Вход' : 'Регистрация' }}</v-card-title>

      <v-card-text>
        <v-form @submit.prevent="submitForm" ref="formRef" v-model="formValid">
          <v-text-field
            v-model="form.email"
            label="Email"
            :rules="emailRules"
            required
            type="email"
            autocomplete="email"
          />

          <v-text-field
            v-model="form.password"
            label="Пароль"
            :rules="passwordRules"
            required
            type="password"
            autocomplete="current-password"
          />

          <v-slide-y-transition>
            <v-text-field
              v-if="!isLogin"
              v-model="form.confirmPassword"
              label="Повторите пароль"
              :rules="confirmPasswordRules"
              type="password"
              autocomplete="new-password"
            />
          </v-slide-y-transition>

          <v-btn
            class="mt-4"
            :disabled="!formValid"
            color="primary"
            type="submit"
            block
            @click="login()"
          >
            {{ isLogin ? 'Войти' : 'Зарегистрироваться' }}
          </v-btn>
        </v-form>
      </v-card-text>

      <v-card-actions class="justify-center">
        <v-btn variant="text" @click="isLogin = !isLogin">
          {{ isLogin ? 'Нет аккаунта? Зарегистрируйтесь' : 'Уже есть аккаунт? Войти' }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script setup>
import router from '@/router'
import { useAuthStore } from '@/stores/auth'
import { ref, computed } from 'vue'

const isLogin = ref(true)
const formRef = ref(null)
const formValid = ref(false)
const auth = useAuthStore()

const form = ref({
  email: '',
  password: '',
  confirmPassword: '',
})

const emailRules = [
  v => !!v || 'Email обязателен',
  v => /.+@.+\..+/.test(v) || 'Некорректный email',
]

const passwordRules = [
  v => !!v || 'Пароль обязателен',
  v => v.length >= 6 || 'Минимум 6 символов',
]

const confirmPasswordRules = [
  v => !!v || 'Подтвердите пароль',
  v => v === form.value.password || 'Пароли не совпадают',
]

const submitForm = () => {
  if (formRef.value?.validate()) {
    if (isLogin.value) {
      // Логика входа
      console.log('Вход:', form.value)
    } else {
      // Логика регистрации
      console.log('Регистрация:', form.value)
    }
  }
}

function login(){
    auth.login({email: form.email})
    router.push('/')
}
</script>

<style scoped>
.fill-height {
  min-height: 100vh;
}
</style>
