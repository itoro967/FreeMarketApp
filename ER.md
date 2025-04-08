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

users||--o{trade_messages:""
orders||--o{trade_messages:""
trade_messages||--o{trade_message_images:""

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
  unsigned_bigint id PK
  unsigned_bigint item_id FK
  unsigned_bigint user_id FK
  string post_code
  string address
  string building
}
trade_messages{
  unsigned_bigint id PK
  unsigned_bigint user_id FK
  unsigned_bigint order_id FK
  text message
  boolean message
  timestamp created_at
  timestamp updated_at
}
trade_message_images{
  unsigned_bigint id PK
  unsigned_bigint trade_message_id FK
  string image_path
  timestamp created_at
  timestamp updated_at
}

```