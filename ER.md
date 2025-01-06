```mermaid
erDiagram

users||--o|items:""

items||--o{comments:""
users||--o{comments:""

items||--o{favorites:""
users||--o{favorites:""

categories||--o{item_category:""
items||--o{item_category:""

items||--o|orders:""
users||--o|orders:""

users{
  unsigned_bigint id PK
  string name
  string email UK
  string email_verified_at
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
  unsigned_bigint user_id FK
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
  string content UK
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
  unsigned_bigint id PK
  unsigned_bigint category_id FK
  unsigned_bigint item_id FK
  timestamp created_at
  timestamp updated_at
}
orders{
  unsigned_bigint item_id PK,FK
  unsigned_bigint user_id PK,FK
  string post_code
  string address
  string building
}
```