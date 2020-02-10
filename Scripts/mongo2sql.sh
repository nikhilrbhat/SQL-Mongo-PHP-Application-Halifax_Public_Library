#!/bin/bash
#
db="$1"
user="$2"
pass="$3"
#
####  Generating data scripts for mysql import
echo "-> Generating the data insert scripts from csv file"
python script_generator.py
#### Starting the data insertion
echo "-> Starting data insertion process"
mysql -u "$user" --password="$pass" "$db" -e "source insert_data.sql;"
echo "-> Data insertion completed"
rm articles_data.csv
rm insert_data.sql

mysql -u "$user" --password="$pass" "$db" -e "Create Index Magazine_Name_INDEX on MAGAZINE(name)"
mysql -u "$user" --password="$pass" "$db" -e "Create Index Volume_Magazine_INDEX on VOLUMES(volume_num,magazine_id)"
mysql -u "$user" --password="$pass" "$db" -e "Create Index Article_Vol_INDEX on ARTICLES(title,volume_id)"