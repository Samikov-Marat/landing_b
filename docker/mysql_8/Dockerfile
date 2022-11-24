FROM mysql/mysql-server:8.0.28

RUN chown mysql:mysql /var/lib/mysql -R
# Удаление файла блокировки после начала работы.
# Не удалось найти нормальное решение
# (Не даёт пересобрать образ)
RUN rm -f /var/lib/mysql/mysql.sock.lock
