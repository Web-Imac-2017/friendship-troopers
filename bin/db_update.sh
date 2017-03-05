#!/bin/bash

echo "Reading config...." >&2
. ./config.cfg

cd ../src/db/
for sql_file in *.sql; do
  if [ -f "./done/$sql_file" ];
  then
    echo "Already imported: $sql_file";
  else
    echo "Importing $sql_file";
    mysql -h $db_host -u $db_username -p$db_password $db_name < $sql_file;
    cp $sql_file done;
  fi
done
