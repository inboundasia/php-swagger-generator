Generate CRUD path for Swagger UI

Setup:

`composer install`

Example:

`php command.php --model=Product --path=/swagger/project/paths`

now structure under `/swagger/project/paths` will become

```
.
+-- paths
|   +-- products
|       +-- _id.yaml
|       +-- index.yaml
```
