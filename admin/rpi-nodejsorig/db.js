// db.js
const mysql = require('mysql2');

// MySQL connection setup
const db = mysql.createConnection({
    host: '157.230.193.209',
    user: 'root', // Replace with your MySQL username
    password: '1goodland_v2', // Replace with your MySQL password
    database: 'u510162695_goodland_db'
});

// Connect to the database
db.connect((err) => {
    if (err) {
        console.error('Database connection failed:', err);
        process.exit(1);
    } else {
        console.log('Connected to MySQL database.');
    }
});

// Export the database connection
module.exports = db;
