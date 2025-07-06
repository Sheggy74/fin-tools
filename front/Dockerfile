# Используем базовый образ для Angular
FROM node:18 as build-stage

# Устанавливаем рабочую директорию
WORKDIR /usr/src/app

# Копируем package.json и package-lock.json
COPY package*.json ./

# Устанавливаем зависимости
RUN npm install --force
RUN npm install -g http-server

# Копируем исходный код
COPY . .

#RUN npm run build

##WORKDIR /usr/src/app/dist

EXPOSE 5173

#CMD ["npm", "run", "test:dev"]
CMD ["npm","run","dev"]
# CMD ["ng","serve","--host","0.0.0.0"]
# Сборка приложения
# RUN npm run build --prod

# Используем Nginx для статических файлов
# FROM nginx:alpine as production-stage
# COPY --from=build-stage /usr/src/app/dist/client-app /usr/share/nginx/html
# COPY ./nginx/nginx.conf /etc/nginx/conf.d/default.conf
# EXPOSE 80
# CMD ["nginx", "-g", "daemon off;"]
