ALTER TABLE AUTHOR MODIFY COLUMN lname nvarchar(1000) NULL;
ALTER TABLE AUTHOR MODIFY COLUMN fname nvarchar(1000) NOT NULL;
ALTER TABLE AUTHOR MODIFY COLUMN email nvarchar(1000) NULL;
ALTER TABLE MAGAZINE MODIFY COLUMN name nvarchar(1000) NOT NULL;
ALTER TABLE MAGAZINE ADD CONSTRAINT UC_Magazine_Name UNIQUE (name);

DROP TABLE if exists BOOKS;
#
create table if not exists BOOKS (
  _id BIGINT not null,
  name nvarchar(1000) not null,
  primary key(_id),
  check(name != '')
);

DROP TABLE if exists VOLUMES;
#
create table if not exists VOLUMES (
  _id INT not null auto_increment,
  volume_num nvarchar(500) not null,
  magazine_id INT SIGNED not null,
  publication_year int,
  primary key(_id,volume_num,magazine_id),
  CONSTRAINT UC_Magazine_Volume UNIQUE (volume_num,magazine_id),
  CONSTRAINT FK_Magazine_Volume FOREIGN KEY (magazine_id) REFERENCES MAGAZINE(_id)
);

DROP TABLE if exists ARTICLES;
#
create table if not exists ARTICLES (
  _id INT not null auto_increment,
  title nvarchar(1000) not null,
  volume_id int not null,
  page_number nvarchar(100),
  primary key(_id),
  CONSTRAINT UC_ArticleDetails UNIQUE (title,volume_id),
  CONSTRAINT FK_Article_Volume FOREIGN KEY (volume_id) REFERENCES VOLUMES(_id)
);

DROP TABLE if exists ARTICLE_AUTHORS;
#
create table if not exists ARTICLE_AUTHORS(
  article_id int not null,
  author_id int not null,
  primary key(article_id,author_id),
  CONSTRAINT FK_Article_Id FOREIGN KEY (article_id) REFERENCES ARTICLES(_id),
  CONSTRAINT FK_Article_Author FOREIGN KEY (author_id) REFERENCES AUTHOR(_id)
);

DROP TABLE if exists CUSTOMER;
#
create table if not exists CUSTOMER (
  CID INT not null auto_increment,
  fname nvarchar(300) not null,
  lname nvarchar(300) not null,
  telephone nvarchar(300) not null,
  mailing_address nvarchar(300) not null,
  discount_code int null,
  primary key(CID)
);

DROP TABLE if exists TRANSACTIONS;
#
create table if not exists TRANSACTIONS (
  transaction_num BIGINT not null auto_increment,
  transaction_date datetime not null,
  customer_id int not null,
  total_price FLOAT(8,2) not null,
  primary key(transaction_num),
  CONSTRAINT FK_Transactions_Customer FOREIGN KEY (customer_id) REFERENCES CUSTOMER(CID)
);

DROP TABLE if exists TRANSACTION_DETAILS;
#
create table if not exists TRANSACTION_DETAILS (
  transaction_num BIGINT SIGNED not null,
  item_id BIGINT SIGNED not null,
  primary key(transaction_num,item_id),
  CONSTRAINT FK_Transactions_Details FOREIGN KEY (transaction_num) REFERENCES TRANSACTIONS(transaction_num),
  CONSTRAINT FK_Transactions_Items FOREIGN KEY (item_id) REFERENCES ITEM(_id)
);

DROP TABLE if exists EMPLOYEE;
#
create table if not exists EMPLOYEE (
  sin int SIGNED not null UNIQUE,
  emp_name nvarchar(1000) not null,
  pay_per_hour float(10,2) not null,
  email nvarchar(1000) not null,
  phone varchar(200) not null,
  mailing_address nvarchar(300) not null,
  primary key(sin)
);

DROP TABLE if exists EMPLOYEE_HOURS;
#
create table if not exists  EMPLOYEE_HOURS(
  sin int SIGNED not null,
  startTime datetime,
  endTime datetime,
  primary key(sin,startTime),
  CONSTRAINT FK_Emp_Hrs FOREIGN KEY (sin) REFERENCES EMPLOYEE(sin)
);

DROP TABLE if exists RENT;
#
create table if not exists RENT(
  years int not null,
  monthly_rent float(8,2),
  primary key(years)
);

DROP TABLE if exists MONTHLY_EXPENSES;
#
create table if not exists MONTHLY_EXPENSES(
  years int not null,
  month int not null,
  electric FLOAT(8,2) not null,
  heat FLOAT(8,2) not null,
  water FLOAT(8,2) not null,
  primary key(years,month),
  CONSTRAINT FK_Monthly_Rent FOREIGN KEY (years) REFERENCES RENT(years)  
);
