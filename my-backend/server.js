const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');

const app = express();

// Middleware
app.use(cors());
app.use(express.json());

// MongoDB connection
mongoose.connect('mongodb://127.0.0.1:27017/myDatabase')
    .then(() => console.log('MongoDB connected'))
    .catch(err => console.log(err));

// User model
const User = mongoose.model('User', new mongoose.Schema({
    name: String,
    email: String,
    password: String
}));

// Routes
app.get('/', (req, res) => {
    res.send('Backend is working!');
});

// Get all users
app.get('/api/users', async (req, res) => {
    const users = await User.find();
    res.json(users);
});

// Add new user
app.post('/api/users', async (req, res) => {
    try {
        const newUser = new User(req.body);
        const savedUser = await newUser.save();
        res.status(201).json(savedUser);
    } catch (err) {
        res.status(400).json({ message: err.message });
    }
});

// Start server
const PORT = 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
