@echo off
echo Adding emoji column to comments table...
mysql -u root -p e_mading < add_emoji_column.sql
echo Done!
pause