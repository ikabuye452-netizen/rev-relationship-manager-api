-- Users table
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    phone TEXT,
    address TEXT,
    last_login_at DATETIME
);

-- Portfolios table
CREATE TABLE portfolios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    net_worth REAL,
    property_equity REAL,
    savings REAL,
    current_account_balance REAL,
    loan_amount REAL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Cashflows (transactions) table
CREATE TABLE cashflows (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    amount REAL NOT NULL,
    type TEXT CHECK(type IN ('credit', 'debit')) NOT NULL,
    description TEXT,
    date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bank accounts table
CREATE TABLE bank_accounts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    bank_name TEXT,
    account_number TEXT,
    balance REAL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Relationship managers table
CREATE TABLE relationship_managers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    phone TEXT,
    address TEXT
);

-- Manager availability table
CREATE TABLE manager_availability (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    manager_id INTEGER NOT NULL,
    available_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    FOREIGN KEY (manager_id) REFERENCES relationship_managers(id)
);

-- Appointments table
CREATE TABLE appointments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    manager_id INTEGER NOT NULL,
    subject TEXT NOT NULL,
    description TEXT,
    attachment_path TEXT,
    appointment_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    meeting_mode TEXT CHECK(meeting_mode IN ('phone', 'video', 'in-person')) NOT NULL,
    status TEXT CHECK(status IN ('pending', 'confirmed', 'cancelled')) DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (manager_id) REFERENCES relationship_managers(id)
);