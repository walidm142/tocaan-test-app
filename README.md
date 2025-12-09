# Tocaan API Documentation

## Overview

Tocaan is a RESTful API for managing users, orders, payments, and authentication. It supports JWT-based authentication and multiple payment gateways (Credit Card, Stripe, PayPal).

## Authentication

All endpoints (except login and register) require JWT authentication. Include the token in the `Authorization: Bearer <token>` header.

### Endpoints

-   `POST /api/v1/login` — Login and receive a JWT token.
-   `POST /api/v1/register` — Register a new user.
-   `GET /api/v1/me` — Get current user info (auth required).
-   `POST /api/v1/logout` — Logout the current user (auth required).

#### Login Response Example

```
{
  "success": true,
  "message": "Success",
  "data": {
    "access_token": "...",
    "token_type": "bearer",
    "expires_in": 1440
  }
}
```

## Orders

-   `GET /api/v1/orders` — List orders (paginated, auth required)
-   `POST /api/v1/orders` — Create order
-   `GET /api/v1/orders/{id}` — Get order details
-   `PUT /api/v1/orders/{id}` — Update order
-   `DELETE /api/v1/orders/{id}` — Delete order
-   `POST /api/v1/orders/{order}/payment` — Generate payment URL for an order

#### Order Response Example

```
{
  "id": 1,
  "customer_name": "John Doe",
  "customer_email": "john@example.com",
  "customer_phone": "1234567890",
  "customer_address": "123 Main St",
  "total_price": 100.00,
  "status": "pending",
  "items": [
    {
      "id": 1,
      "product_name": "Product A",
      "quantity": 2,
      "price": 50.00,
      "total_price": 100.00
    }
  ],
  "created_by": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2024-06-10 12:00:00",
    "updated_at": "2024-06-10 12:00:00"
  }
}
```

#### Paginated Response Example

```
{
  "success": true,
  "message": "Orders retrieved successfully",
  "data": [ ...orders... ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 10,
    "total": 50
  }
}
```

## Payments

-   `GET /api/v1/payments` — List payments (paginated, auth required)
-   `GET /api/v1/payments/{id}` — Get payment details

#### Payment Response Example

```
{
  "id": 1,
  "payment_method": "stripe",
  "amount": 100.00,
  "status": "pending",
  "order": { ...order... },
  "created_at": "2024-06-10 12:00:00",
  "updated_at": "2024-06-10 12:00:00"
}
```

## Payment Gateway

-   Supported gateways: Credit Card, Stripe, PayPal
-   Gateway selection is controlled by the `PAYMENT_GATEWAY` environment variable or by passing `payment_method` in the payment request.
-   Stripe and PayPal credentials are loaded from `.env` (`STRIPE_KEY`, `PAYPAL_CLIENT_ID`, `PAYPAL_SECRET`).

## Error Response Example

```
{
  "success": false,
  "message": "Invalid credentials",
  "errors": []
}
```

## Environment Variables

-   `PAYMENT_GATEWAY`: Default payment gateway
-   `STRIPE_KEY`: Stripe API key
-   `PAYPAL_CLIENT_ID`: PayPal client ID
-   `PAYPAL_SECRET`: PayPal secret

## Filtering

-   Orders can be filtered by status and other fields using query parameters.

## JWT Setup

Tocaan uses JWT (JSON Web Tokens) for authentication. To set up JWT:

1. Install the JWT package (if not already):
    ```bash
    composer require tymon/jwt-auth
    ```
2. Publish the JWT config:
    ```bash
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    ```
3. Generate a JWT secret key:
    ```bash
    php artisan jwt:secret
    ```
    This will add `JWT_SECRET` to your `.env` file.
4. Configure other JWT settings in `config/jwt.php` as needed.

**Note:**

-   All protected endpoints require the JWT token in the `Authorization: Bearer <token>` header.
-   You can change the expiration time by modifying `JWT_TTL` in `.env`.

## Setup & Testing

-   Configure your `.env` file with database and payment gateway credentials.
-   Run migrations: `php artisan migrate`
-   Run tests: `php artisan test`

---

For more details, see the source code or contact the API maintainer.
