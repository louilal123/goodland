const { SerialPort } = require('serialport');
const { ReadlineParser } = require('@serialport/parser-readline');

// Replace with your actual serial port (e.g., /dev/ttyUSB0 or /dev/ttyACM0)
const port = new SerialPort({
    path: '/dev/ttyUSB0',
    baudRate: 9600,
});

// Create a readline parser
const parser = port.pipe(new ReadlineParser({ delimiter: '\n' }));

// Listen for data from the Arduino
parser.on('data', (data) => {
    console.log(`Received: ${data}`);
});

// Handle any errors
port.on('error', (err) => {
    console.error(`Error: ${err.message}`);
});
