WITH sales_this_year AS (
  SELECT p.item_id, SUM(o.total_amt_paid) AS sales 
  FROM orders o
    JOIN products p ON o.item_id = p.item_id
  WHERE o.order_status = 'completed' AND YEAR(o.date_ordered) = YEAR(CURDATE()) 
  GROUP BY p.item_id
), 

sales_last_year AS (
  SELECT p.item_id, SUM(o.total_amt_paid) AS sales 
  FROM orders o
    JOIN products p ON o.item_id = p.item_id
  WHERE o.order_status = 'completed' AND YEAR(o.date_ordered) = YEAR(CURDATE()) - 1 
  GROUP BY p.item_id
)

SELECT 
  LOWER(p.item_name) AS item_name, 
  COALESCE(SUM(CASE WHEN YEAR(o.date_ordered) = YEAR(CURDATE()) THEN o.total_amt_paid ELSE 0 END), 0) AS TY, 
  COALESCE(SUM(CASE WHEN YEAR(o.date_ordered) = YEAR(CURDATE()) - 1 THEN o.total_amt_paid ELSE 0 END), 0) AS LY
FROM products p 
  JOIN orders o ON p.item_id = o.item_id 
  WHERE p.item_status = 'active' AND o.order_status = 'completed'
GROUP BY LOWER(p.item_name)

UNION

SELECT LOWER(p.item_name) AS item_name, 0 AS TY, 
  COALESCE(SUM(o.total_amt_paid), 0) AS LY
FROM products p 
  JOIN sales_last_year o ON p.item_id = o.item_id 
WHERE p.item_status = 'active' 
GROUP BY LOWER(p.item_name)
HAVING 
  SUM(CASE WHEN YEAR(o.date_ordered) = YEAR(CURDATE()) THEN o.total_amt_paid ELSE 0 END) = 0;
