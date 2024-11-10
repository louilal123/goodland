const { SerialPort } = require('serialport');
const { ReadlineParser } = require('@serialport/parser-readline');
const db = require('./db'); // Import the database module

// Set up the serial port (adjust the port as necessary, e.g., '/dev/ttyUSB0')
const port = new SerialPort({
    path: '/dev/ttyUSB0', // Specify the path explicitly
    baudRate: 9600,       // Set the baud rate
});

// Use Readline parser to read incoming serial data line by line
const parser = port.pipe(new ReadlineParser({ delimiter: '\n' }));

// Variables to store the latest sensor readings
const kit_name = "esawod_1";
let level = null;
let humidity = null;
let temperature = null;

// Function to handle serial data
parser.on('data', (data) => {
    console.log(`Received: ${data.trim()}`);

    // Extract level, humidity, and temperature from the received data
    const levelMatch = data.match(/Level:\s(\d+)\s*cm/);
    const humidityMatch = data.match(/Humidity:\s([\d.]+)\s*%/);
    const temperatureMatch = data.match(/Temperature:\s([\d.]+)\s*°C/);

    // Update variables with the latest sensor values
    if (levelMatch) level = parseInt(levelMatch[1]);
    if (humidityMatch) humidity = parseFloat(humidityMatch[1]);
    if (temperatureMatch) temperature = parseFloat(temperatureMatch[1]);
});

// Function to insert data into MySQL every 5 seconds
setInterval(() => {
    // Only insert if at least one value has been updated
    if (level !== null || humidity !== null || temperature !== null) {
        const query = `INSERT INTO sensor_data (kit_name, level_cm, humidity, temperature) VALUES (?, ?, ?, ?)`;
        db.query(query, [kit_name, level, humidity, temperature], (err, result) => {
            if (err) {
                console.error('Error inserting data:', err);
                return;
            }
            console.log('Data inserted successfully:', result.insertId);
            console.log(`Level: ${level}, Humidity: ${humidity}, Temperature: ${temperature}`);

            // Reset the sensor values after inserting
            level = null;
            humidity = null;
            temperature = null;
        });
    }
}, 5000); // 5000 ms = 5 seconds

// Handle serial port errors
port.on('error', (err) => {
    console.error('Serial port error:', err);
});

// Close MySQL connection when the script is terminated
process.on('SIGINT', () => {
    db.end(() => {
        console.log('MySQL connection closed.');
        process.exit();
    });
});
