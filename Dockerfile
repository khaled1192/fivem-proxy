# استخدم صورة PHP الرسمية مع Apache
FROM php:8.1-apache

# انسخ محتويات المجلد الحالي إلى مجلد الويب في الحاوية
COPY . /var/www/html/

# افتح بورت 80
EXPOSE 80

# افعل مودول إعادة كتابة الروابط (اختياري)
RUN a2enmod rewrite
