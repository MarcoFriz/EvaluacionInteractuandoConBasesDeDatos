const mongoose = require('mongoose');
var Schema = mongoose.Schema;

var userSchema= new Schema({
	userId: {type: Number, required: true, unique: true},
	userName: {type: String, required: true},
	userPass: {type: String, required: true}
})

var eventSchema= new Schema({
	id: {type: Number, required: true, unique: true},
	title: {type: String, required: true},
	start: {type: String, required: true},
	end: {type: String},
	allDay: {type: Boolean, required: true},
})

var User = mongoose.model("User",userSchema,"usuarios")
var Event = mongoose.model("Event",eventSchema,"eventos")

module.exports.User = User;
module.exports.Event = Event;
