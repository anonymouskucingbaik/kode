// server.js - Backend proxy menggunakan Node.js + Express
// Jalankan: node server.js

const express = require('express');
const fetch = require('node-fetch');
const cors = require('cors');

const app = express();
app.use(cors());

const PORT = process.env.PORT || 3000;

app.get('/api/token', async (req, res) => {
    try {
        const response = await fetch('https://mydeena.com/70k3n.php', {
            timeout: 10000
        });

        if (!response.ok) {
            return res.status(502).json({ error: 'Tidak bisa connect ke mydeena.com' });
        }

        const data = await response.json();
        res.json(data);

    } catch (error) {
        console.error('Error:', error);
        res.status(500).json({ error: error.message });
    }
});

// Serve static files (jika token_viewer.html ada di folder public)
app.use(express.static('public'));

app.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
});
