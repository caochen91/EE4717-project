use f33ee;

create table products
(
    productid int unsigned not null auto_increment primary key,
    name char(50) not null,
    abbre_name char(10) not null, 
    price float(4,2) not null
);

create table sales
(
    saleid int unsigned not null auto_increment primary key,
    salegroupid int unsigned not null, 
    productid int unsigned not null,
    quantity int unsigned not null,
    amount float(4,2) not null
);