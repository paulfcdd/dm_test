# DM test

## How to run
- run `docker compose up -d`
- login to `app` host: `docker compose exec app bash`
- run `cp .env .env.local`
- configure db connection in `.env.local` file
- run `bin/console doctrine:database:create`
- fill the `product` table with data

## How to use
- `/api/order`
  - Method: `POST`
  - Body:
    ```json
    {
      "items": [
        {
          "product_id": 1,
          "quantity": 2
        },
        {
          "product_id": 2,
          "quantity": 2
        },
        {
          "product_id": 3,
          "quantity": 5
        }
      ]
    }
    ```
  - Response:
    ```json
      {
        "id": "0f564ab4-3f33-4741-857f-cc29f58c8c69",
        "createdAt": "2024-05-24T15:14:28+00:00",
        "items": [
          {
            "productName": "Apple",
            "quantity": 2,
            "unitPrice": 2.99,
            "totalPrice": 5.98
          },
          {
            "productName": "Bread",
            "quantity": 2,
            "unitPrice": 3.99,
            "totalPrice": 7.98
          },
          {
            "productName": "Sausages",
            "quantity": 5,
            "unitPrice": 4.99,
            "totalPrice": 24.95
          }
        ],
        "grossPrice": 38.91,
        "netPrice": 31.63,
        "vat": 7.28
      }
      ```
- `/api/order/{id}`
    - Method: `GET`
    - Parameter: `id` - order id
    - Response:
      ```json
      {
        "id": "0f564ab4-3f33-4741-857f-cc29f58c8c69",
        "createdAt": "2024-05-24T15:14:28+00:00",
        "items": [
          {
            "productName": "Apple",
            "quantity": 2,
            "unitPrice": 2.99,
            "totalPrice": 5.98
          },
          {
            "productName": "Bread",
            "quantity": 2,
            "unitPrice": 3.99,
            "totalPrice": 7.98
          },
          {
            "productName": "Sausages",
            "quantity": 5,
            "unitPrice": 4.99,
            "totalPrice": 24.95
          }
        ],
        "grossPrice": 38.91,
        "netPrice": 31.63,
        "vat": 7.28
      }
      ```