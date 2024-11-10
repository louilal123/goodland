const express = require('express');
const db = require('./db'); // Import the database connection
const app = express();

// Route to fetch data from the database
app.get('/data', (req, res) => {
  const query = 'SELECT * FROM sensor_data'; // Replace with your table name
  db.query(query, (err, results) => {
    if (err) {
      console.error('Error fetching data:', err);
      res.status(500).send('Server error');
    } else {
      res.json(results); // Send data as JSON
    }
  });
});

// Serve static files (such as `index.html` in the `public` folder)
app.use(express.static('public'));

// Start the server (only if not already managed by the hosting environment)
if (!process.env.PRODUCTION) {
  const port = process.env.PORT || 3000;
  app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
  });
}

module.exports = app; // Export the app for server or testing
