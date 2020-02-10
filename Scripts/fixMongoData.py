import csv
with open('articlesT2.csv', 'r') as f:
    with open('articles_data.csv', mode='w') as csv_file:
        d_reader = csv.DictReader(f)
        fieldnames = ['title','journal','volume','year','pages','author']
        writer = csv.DictWriter(csv_file, fieldnames=fieldnames)
        writer.writeheader()
        
        for line in d_reader:
            if(line['title'].find('{') > 0 or line['title'].find('}') > 0 or line['journal'] == '' or line['journal'] == 'null' or line['volume'] == '' or line['volume'] == 'null' or line['pages'] == '' or line['pages'] == 'null' or line['pages'] == 'null' or line['author'] == ''):
                continue
            else:
                line['title'] = line['title'].replace('"',' ').replace("'",' ').replace('{','').replace('}','')
                line['journal'] = line['journal'].replace('"',' ').replace("'",' ').replace('{','').replace('}','')   
                if(line['author'] != "" and line['author'].strip() != ""):
                    auth = line['author']
                auth = auth.strip('][').replace('"','').split(',')
                writer.writerow({'title': line['title'], 'journal': line['journal'], 'volume': line['volume'],'year':line['year'],'pages':line['pages'],'author':auth})
    csv_file.close()
