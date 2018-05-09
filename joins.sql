/*OUTER JOIN*/

SELECT C.lastname,A.street,A.city 
FROM tb_customers C LEFT JOIN tb_addresses A on C.id = A.cid 
UNION 
SELECT C.lastname,A.street,A.city 
FROM tb_customers C RIGHT JOIN tb_addresses A on C.id = A.cid


/*LEFT JOIN */
SELECT C.lastname,A.street,A.city 
FROM tb_customers C LEFT JOIN tb_addresses A on C.id = A.cid 


/*RIGHT JOIN*/

SELECT C.lastname,A.street,A.city 
FROM tb_customers C RIGHT JOIN tb_addresses A on C.id = A.cid 

/*INNER JOIN */

SELECT C.lastname,A.street,A.city 
FROM tb_customers C INNER JOIN tb_addresses A on C.id = A.cid 


/*INNER JOIN mit Alias */
SELECT C.id AS CID,A.id AS AID,C.lastname,A.street,A.city
FROM tb_customers C INNER JOIN tb_addresses A on C.id = A.cid

/**/

SELECT 
C.id AS CID,A.id AS AID,C.lastname,A.street,A.city
FROM 
tb_customers C 
INNER JOIN tb_addresses A 
on C.id = A.cid
WHERE 
c.lastname = 'Emil' 
OR 
c.lastname = 'Boy' 
ORDER BY city



SELECT 
C.id AS CID,A.id AS AID,C.lastname,A.street,A.city
FROM 
tb_customers C 
INNER JOIN tb_addresses A 
on C.id = A.cid
WHERE 
c.lastname LIKE 'E%'
ORDER BY city


