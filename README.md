# STUDY ABOUT API'S

## URL EXAMPLE
[ENDPOINT]
TO ALL GET ALL ROUTES
``` bash
    curl http://localhost/study/api/index.php?endpoint={ENDPOINT}
```

[ENDPOINT][ID]
TO ALL GET BY ID ROUTES
``` bash
    curl http://localhost/study/api/index.php?endpoint={ENDPOINT}&id={ID}
```

[METHOD][ENDPOINT]
# ENDPOINTS DEVELOPE
## Users
GET get_all_users
GET get_user_by_id
GET get_all_active_users
GET get_all_inactive_users
## Products
GET get_all_products
GET get_product_by_id
GET get_all_active_products
GET get_all_inactive_products
GET products without stock
GET products with stock
## Clients
GET get_all_clients
GET get_client_by_id
POST create_client
- DELETE delete_client
- PUT edit_client
