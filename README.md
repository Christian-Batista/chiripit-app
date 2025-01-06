# ChiripitaApp

### Application porpuse

The application aims to connect users who need specific services (electricians, technicians, plumbers, among others) with local providers who can solve these problems quickly and effectively. It seeks to empower providers, promoting the formalization of their work and offering a system accessible to all.

### Features

1. User registration
```sh
POST /api/register
{
    "name": "John",
    "last_name": "Doe",
    "email": "9X4Qg@example.com",
    "password": "password123",
    
}
response:
{
    "cod": "S-00",
    "msg": "User created.",
    "token": "1|ZGI5a48A57r7gzDoqWOHmGvPl6k5A6pHyl3ZLSGh8c6e1d68"
}
```

2. User login
```sh
POST /api/login
{
    "email": "9X4Qg@example.com",
    "password": "password123"
}
response:
{
    "cod": "S-01",
        "msg": "Usuario logueado correctamente.",
        "token": "3|iFW2xOlYx6elplCM4eFGMvl0a0gBKHBQumZ73MIldf6ba19f"
}
```
