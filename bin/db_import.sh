#!/bin/bash

echo "Reading config...." >&2
. ./config.cfg

echo "Call example: ./db_import.sh wannago@vps13994.ovh.net:./prod/www/db/ wannago.sql.gz"
echo "Are you sure to import database from $1$2 to $db_name (cancel ^C)?"
read $answer

echo "Updating database...." >&2
scp $1$2 ../tmp/
gunzip < ./tmp/$2 | mysql -u $db_username -p$db_password $db_name
