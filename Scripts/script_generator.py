import csv
import ast
file = open("insert_data.sql","w")

with open('articles_data.csv', 'r') as f:
    d_reader = csv.DictReader(f)
    
    for line in d_reader:
        authorDt = ast.literal_eval(line['author'])
        query = 'INSERT INTO MAGAZINE (name) SELECT "{0}" WHERE NOT EXISTS (SELECT name FROM MAGAZINE WHERE name="{0}");\n'
        query += 'INSERT INTO VOLUMES (volume_num,magazine_id,publication_year) SELECT "{1}",m._id,{2} from MAGAZINE m where name = "{0}" and NOT EXISTS (SELECT _id from VOLUMES where volume_num = "{1}" and magazine_id = m._id);\n'       
        query += 'INSERT INTO ARTICLES (title,volume_id,page_number) SELECT "{3}",v._id,"{4}" from VOLUMES v where v.volume_num = "{1}" and v.magazine_id = (SELECT _id from MAGAZINE where name="{0}") and NOT EXISTS (SELECT _id from ARTICLES where title="{3}" and volume_id = v._id);\n'
        query = query.format(line['journal'],line['volume'],line['year'],line['title'],line['pages'])

        for authCount in authorDt:
            spaceCount = authCount.count(' ')
            if(spaceCount == 1):
                name = authCount.split(' ')
            elif(spaceCount == 0):
                name = authCount
            else:
                name = authCount.split(" ", 1)
            
            query += 'INSERT INTO AUTHOR (lname,fname) SELECT "{0}","{1}" where NOT EXISTS (SELECT _id from AUTHOR where lname="{0}" and fname="{1}");\n'
            query += 'INSERT IGNORE INTO ARTICLE_AUTHORS (article_id,author_id) SELECT (SELECT _id from ARTICLES where title="{2}" and volume_id= (SELECT _id from VOLUMES where volume_num= {3} and magazine_id=(SELECT _id from MAGAZINE where name="{4}"))) as article_id, (SELECT _id from AUTHOR where lname="{0}" and fname="{1}" ) as auth_id;\n'
            query = query.format(name[1],name[0],line['title'],line['volume'],line['journal'])
        file.write(query)
file.close()
