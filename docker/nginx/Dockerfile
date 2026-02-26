FROM nginx:latest

# Скопировать содержимое папки "conf.d" / файл конфигурации nginx "default.conf" в папку "/etc/nginx/conf.d/"
# Если указать прямой файл например "./conf.d/default.conf:/etc/nginx/conf.d/default.conf:ro" - "ro" означает здесь
# только чтение без возможности изменения нашего файла "default.conf" сервером nginx
COPY ./conf.d/ /etc/nginx/conf.d/

WORKDIR /var/www