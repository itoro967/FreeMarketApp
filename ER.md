```mermaid
erDiagram

comments}o--||users:""
comments}o--||items:""
favorites}o--||users:""
favorites}o--||items:""

item_category}o--||categories:""
item_category}|--||items:""
orders}o--||users:""

users{
  unsigned_bigint id PK
  string name
  string email UK
  string password
  string post_code
  string address
  string building
  timestamp created_at
  timestamp updated_at
}
items{
  unsigned_bigint id PK
  string image
  string name
  string brand
  unsigned_integer price
  string description
  string condition
  timestamp created_at
  timestamp updated_at
}
comments{
  unsigned_bigint id PK
  unsigned_bigint user_id FK
  unsigned_bigint item_id FK
  string content
  timestamp created_at
  timestamp updated_at
}
categories{
  unsigned_bigint id PK
  string content
  timestamp created_at
  timestamp updated_at
}
favorites{
  unsigned_bigint item_id PK,FK
  unsigned_bigint user_id PK,FK
  timestamp created_at
  timestamp updated_at
}
item_category{
  unsigned_bigint category_id PK,FK
  unsigned_bigint item_id PK,FK
  timestamp created_at
  timestamp updated_at
}
orders{
  unsigned_bigint id PK
  unsigned_bigint item_id FK
  string post_code
  string address
  string building
}
```