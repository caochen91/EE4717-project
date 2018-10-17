use f33ee;

insert into products values
  (0, "Just Java", "JJ", 2.00),
  (1, "Cafe au Lait (Single)", "CALsgl", 2.00),
  (2, "Cafe au Lait (Double)", "CALdbl", 3.00),
  (3, "Iced Cappuccino (Single)", "ICsgl", 4.75),
  (4, "Iced Cappuccino (Double)", "ICdbl", 5.75);




-- create table sales
-- (
--     saleid int unsigned not null auto_increment primary key,
--     salegroupid int unsigned not null, 
--     productid int unsigned not null,
--     quantity int unsigned not null,

--     amount float(4,2) not null
-- );

--(saleid, salegroupid, productid, quantity, amount)

insert into sales values
  (0, 0, 0, 1, 2.00),
  (1, 0, 1, 1, 2.00),
  (2, 1, 0, 1, 4.00),
  (3, 1, 3, 2, 9.50);
  
  