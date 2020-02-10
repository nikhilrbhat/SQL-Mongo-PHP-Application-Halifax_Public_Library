#!/bin/bash
#
db="$1" 
user="$2" 
pass="$3"
#
echo
#### Commands to drop and load tables
mysql -u "$user" --password="$pass" "$db" -e "source drp_tbl.sql;" 
mysql -u "$user" --password="$pass" "$db" -e "source existing_tables.sql;" 
mysql -u "$user" --password="$pass" "$db" -e "source new_tables.sql;" 
#### Commands to drop collections in mongo
mongo $db -u $user -p $pass --eval "db=db.getSiblingDB('$db');db.articlesTemp.drop();db.authors.drop();db.articles.drop();" 
#### Commands to create a temporary schema structure for articles to validate authors and required fields are present
mongo $db -u $user -p $pass --eval '
	db.createCollection("articlesTemp", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: [ "title", "journal", "volume", "year", "pages", "author"]
	}
   },
   validationAction: "error"
});'
#### Importing json data from articles.json
mongoimport -d $db -u $user -p=$pass -c articlesTemp --file articles.json --jsonArray;
mongoexport -d $db -u $user -p=$pass -c articlesTemp --type csv --fields title,journal,volume,year,pages,author --out articlesT2.csv;

#### Export author data from mysql
mysql -u "$user" --password="$pass" "$db" -e 'select * from AUTHOR' | sed  's/\t/,/g' > authors_data.csv
#### Fix data formatting in mongoDB
python fixMongoData.py
#### Import data in final schema and drop temporary tables
mongoimport -d $db -u $user -p=$pass -c articles --file articles_data.csv --headerline --type csv;
mongoimport -d $db -u $user -p=$pass -c authors --file authors_data.csv --headerline --type csv;
echo "db.articlesTemp.drop()" | mongo "$db" -u "$user" --password="$pass";
echo "-> Imported articles.json into Mongodb collection \"articles\""
rm articlesT2.csv
rm authors_data.csv
