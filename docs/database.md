# The database plan

## Tables

### User

- (PK) UID
- Encrypted Master Key
- Hashed Password
- Username

### Passwords

- (FK, PK) UID
- (PK) PID
- Encrypted Password
- Website / App name
- Creation date
- Site username

```mermaid
classDiagram
    direction BT
    class passwords {
        text password
        text site_name
        datetime creation_date
        text username
        int uid
        int pid
    }
    class user {
        text master_key
        varchar(255) pwd
        varchar(30) username
        int uid
    }

    passwords  -->  user : uid
```