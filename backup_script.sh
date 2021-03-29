#!/bin/bash


BACKUPS_PATH=/home/shefng1z/backups
SQL_PREFIX=shefng1z_gibb201
ZIP_PREFIX=core_gyansetu_bak

# Database backup
echo "Database backup..."
/usr/bin/mysqldump -u shefng1z_gibb201 -p3.zh9p.Sh7 shefng1z_gibb201 > ${BACKUPS_PATH}/${SQL_PREFIX}_`date +\%F`.sql

if [ $? -eq 0 ]; then
    echo "Alright!!"
else
    echo "FAIL :("
fi
echo

# Source backup
echo "Source backup..."
/usr/bin/zip -rv ${BACKUPS_PATH}/${ZIP_PREFIX}_`date +\%F`.zip /home/shefng1z/public_html/core_gyansetu > /dev/null

if [ $? -eq 0 ]; then
    echo "Alright!!"
else
    echo "FAIL :("
fi

echo
echo

# Remove some past backups
cd $BACKUPS_PATH

CURRENT_YEAR=`date +%Y`
CURRENT_MONTH=`date +%m`
LAST_MONTH=`printf "%02d" $(expr ${CURRENT_MONTH} - 1)`

for FILENAME in *.sql *.zip
do
  if [[ ${FILENAME} = "${SQL_PREFIX}_"* ]] || \
     [[ ${FILENAME} = "${ZIP_PREFIX}_"* ]]; then

    if [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${CURRENT_MONTH}-"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-04"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-08"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-16"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-12"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-20"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-24"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-28"* ]] || \
       [[ ${FILENAME} = "${SQL_PREFIX}_"*"-28"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${CURRENT_MONTH}-"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-04"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-08"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-16"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-12"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-20"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-24"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_${CURRENT_YEAR}-${LAST_MONTH}-28"* ]] || \
       [[ ${FILENAME} = "${ZIP_PREFIX}_"*"-28"* ]]; then
         echo 'Saving '${FILENAME}' from destruction'
         # Save the file
         continue
       else
         # Remove the file
         echo 'Removing '${FILENAME}' without mercy'
         rm ${FILENAME}
       fi
    else
      # Save the file
      echo 'Saving '${FILENAME}' from destruction'
    fi
done
