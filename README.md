### Support Ticket System api

### Startup Instruction
- php aritsan migrate:fresh --seed [Seeding the db]
- hit login 📮POST /api/login to generate a token
- use the token as bearar token to serve throughout application

### Filtering Details(custom)
- Sort by Status `/tickets?status=X`
- More {implemented but not documented till now}

### Startup Instruction
- php aritsan migrate:fresh --seed [Seeding the db]
- hit login 📮POST /api/login to generate a token
- use the token as bearar token to serve throughout application

### Filtering Details(custom)
Sort : Data field(s) to sort by. Separate multiple fields with commas. Denote descending sort with a minus sign.
`sort=title,-createdAt`
Filter : Filter by status code: A, C, H, X.
`filter[status]`, `filter[title]`
- 

## API Endpoints

### Ticket Endpoints

**use v1 prefix for each endpoints
like: /api/v1/tickets
except: login and logout route
**


#### GET /api/tickets 🔒
- **Description**: List all tickets
- **Request Body**: None
- **Response Body**:
  ```json
  [
    {
      "type": "ticket",
      "id": 1,
      "attributes": {
        "title": "Sample Ticket",
        "description": "This is a sample ticket",
        "status": "open",
        "createdAt": "2023-01-01T00:00:00.000000Z",
        "updatedAt": "2023-01-01T00:00:00.000000Z"
      },
      "relationship": {
        "author": {
          "type": "user",
          "id": 1
        },
        "links": {
          "self": "http://example.com/tickets/1"
        }
      }
    }
  ]
  ```

#### POST /api/tickets 🔒
- **Description**: Create a new ticket
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "title": "New Ticket",
        "description": "Description of the new ticket",
        "status": "open"
      },
      "relationships": {
        "author": {
          "id": 1
        }
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 2,
    "attributes": {
      "title": "New Ticket",
      "description": "Description of the new ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/2"
      }
    }
  }
  ```

#### GET /api/tickets/{ticket} 🔒
- **Description**: Get a specific ticket
- **Request Body**: None
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 1,
    "attributes": {
      "title": "Sample Ticket",
      "description": "This is a sample ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/1"
      }
    }
  }
  ```

#### DELETE /api/tickets/{ticket} 🔒
- **Description**: Delete a specific ticket
- **Request Body**: None
- **Response Body**:
  ```json
  {
    "message": "Ticket deleted successfully"
  }
  ```

#### PUT /api/tickets/{ticket} 🔒
- **Description**: Replace a specific ticket
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "title": "Updated Ticket",
        "description": "Updated description of the ticket",
        "status": "open"
      },
      "relationships": {
        "author": {
          "id": 1
        }
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 1,
    "attributes": {
      "title": "Updated Ticket",
      "description": "Updated description of the ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/1"
      }
    }
  }
  ```

#### PATCH /api/tickets/{ticket} 🔒
- **Description**: Update a specific ticket
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "title": "Partially Updated Ticket"
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 1,
    "attributes": {
      "title": "Partially Updated Ticket",
      "description": "This is a sample ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/1"
      }
    }
  }
  ```

<hr>

### User Endpoints

#### GET /api/users 🔒
- **Description**: List all users
- **Request Body**: None
- **Response Body**:
  ```json
  [
    {
      "type": "user",
      "id": 1,
      "attributes": {
        "name": "John Doe",
        "email": "john@example.com",
        "isManager": true,
        "createdAt": "2023-01-01T00:00:00.000000Z",
        "updatedAt": "2023-01-01T00:00:00.000000Z"
      },
      "links": {
        "self": "http://example.com/users/1"
      }
    }
  ]
  ```

#### POST /api/users 🔒
- **Description**: Create a new user
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "name": "Jane Doe",
        "email": "jane@example.com",
        "password": "password",
        "isManager": true
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "user",
    "id": 2,
    "attributes": {
      "name": "Jane Doe",
      "email": "jane@example.com",
      "isManager": true,
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "links": {
      "self": "http://example.com/users/2"
    }
  }
  ```

#### GET /api/users/{user} 🔒
- **Description**: Get a specific user
- **Request Body**: None
- **Response Body**:
  ```json
  {
    "type": "user",
    "id": 1,
    "attributes": {
      "name": "John Doe",
      "email": "john@example.com",
      "isManager": true,
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "links": {
      "self": "http://example.com/users/1"
    }
  }
  ```

#### DELETE /api/users/{user} 🔒
- **Description**: Delete a specific user
- **Request Body**: None
- **Response Body**:
  ```json
  {
    "message": "User deleted successfully"
  }
  ```

#### PUT /api/users/{user} 🔒
- **Description**: Replace a specific user
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "name": "Updated User",
        "email": "updated@example.com",
        "password": "newpassword",
        "isManager": true
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "user",
    "id": 1,
    "attributes": {
      "name": "Updated User",
      "email": "updated@example.com",
      "isManager": true,
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "links": {
      "self": "http://example.com/users/1"
    }
  }
  ```

#### PATCH /api/users/{user} 🔒
- **Description**: Update a specific user
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "name": "Partially Updated User"
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "user",
    "id": 1,
    "attributes": {
      "name": "Partially Updated User",
      "email": "john@example.com",
      "isManager": true,
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "links": {
      "self": "http://example.com/users/1"
    }
  }
  ```

<hr>

### Author Endpoints

#### GET /api/authors 🔒
- **Description**: List all authors
- **Request Body**: None
- **Response Body**:
  ```json
  [
    {
      "type": "user",
      "id": 1,
      "attributes": {
        "name": "Author Name",
        "email": "author@example.com",
        "isManager": true,
        "createdAt": "2023-01-01T00:00:00.000000Z",
        "updatedAt": "2023-01-01T00:00:00.000000Z"
      },
      "links": {
        "self": "http://example.com/authors/1"
      }
    }
  ]
  ```

#### GET /api/authors/{author} 🔒
- **Description**: Get a specific author
- **Request Body**: None
- **Response Body**:
  ```json
  {
    "type": "user",
    "id": 1,
    "attributes": {
      "name": "Author Name",
      "email": "author@example.com",
      "isManager": true,
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "links": {
      "self": "http://example.com/authors/1"
    }
  }
  ```

<hr>

### Tickets under a Author Endpoints

#### GET /api/authors/{author}/tickets 🔒
- **Description**: List all tickets for a specific author
- **Request Body**: None
- **Response Body**:
  ```json
  [
    {
      "type": "ticket",
      "id": 1,
      "attributes": {
        "title": "Sample Ticket",
        "description": "This is a sample ticket",
        "status": "open",
        "createdAt": "2023-01-01T00:00:00.000000Z",
        "updatedAt": "2023-01-01T00:00:00.000000Z"
      },
      "relationship": {
        "author": {
          "type": "user",
          "id": 1
        },
        "links": {
          "self": "http://example.com/tickets/1"
        }
      }
    }
  ]
  ```

#### POST /api/authors/{author}/tickets 🔒
- **Description**: Create a new ticket for a specific author
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "title": "New Ticket",
        "description": "Description of the new ticket",
        "status": "open"
      },
      "relationships": {
        "author": {
          "id": 1
        }
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 2,
    "attributes": {
      "title": "New Ticket",
      "description": "Description of the new ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/2"
      }
    }
  }
  ```

#### GET /api/authors/{author}/tickets/{ticket} 🔒
- **Description**: Get a specific ticket for a specific author
- **Request Body**: None
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 1,
    "attributes": {
      "title": "Sample Ticket",
      "description": "This is a sample ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/1"
      }
    }
  }
  ```

#### DELETE /api/authors/{author}/tickets/{ticket} 🔒
- **Description**: Delete a specific ticket for a specific author
- **Request Body**: None
- **Response Body**:
  ```json
  {
    "message": "Ticket deleted successfully"
  }
  ```

#### PUT /api/authors/{author}/tickets/{ticket} 🔒
- **Description**: Replace a specific ticket for a specific author
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "title": "Updated Ticket",
        "description": "Updated description of the ticket",
        "status": "open"
      },
      "relationships": {
        "author": {
          "id": 1
        }
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 1,
    "attributes": {
      "title": "Updated Ticket",
      "description": "Updated description of the ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/1"
      }
    }
  }
  ```

#### PATCH /api/authors/{author}/tickets/{ticket} 🔒
- **Description**: Update a specific ticket for a specific author
- **Request Body**:
  ```json
  {
    "data": {
      "attributes": {
        "title": "Partially Updated Ticket"
      }
    }
  }
  ```
- **Response Body**:
  ```json
  {
    "type": "ticket",
    "id": 1,
    "attributes": {
      "title": "Partially Updated Ticket",
      "description": "This is a sample ticket",
      "status": "open",
      "createdAt": "2023-01-01T00:00:00.000000Z",
      "updatedAt": "2023-01-01T00:00:00.000000Z"
    },
    "relationship": {
      "author": {
        "type": "user",
        "id": 1
      },
      "links": {
        "self": "http://example.com/tickets/1"
      }
    }
  }
  ```

### Notes
- 🔒 indicates that the endpoint is protected by authentication (requires a valid token).
