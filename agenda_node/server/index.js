const http = require('http');
const path = require('path');
const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');
const users = require('./users.js')
const events = require('./events.js')
var MongoClient = require("mongodb").MongoClient

const PORT = 8082;
const app = express()
var url = "mongodb://localhost/agenda"

const Server = http.createServer(app)

mongoose.connect(url, { useNewUrlParser: true })
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended: true}))
app.use(express.static('client'))
app.use('/user', users)
app.use('/events', events)


Server.listen(PORT,()=>{
	console.log("Conectados al puerto: "+PORT);
})
