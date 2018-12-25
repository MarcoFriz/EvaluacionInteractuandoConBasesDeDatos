var models = require('./models.js')
User = models.User;
Evento = models.Event;

let newRegistro =  function(Model, value, callback){
	let registro = new Model(value);
	registro.save((error)=>{
		if(error)callback(error)
		callback(null,"Registro Guardado")
	})
}
let searchRegistro = function(Model, value, callback){
	Model.find(value).exec((error,result)=>{
			if(error)callback(error);
			callback(null,result);
	})
}
let deleteRegistro = function(Model, value, callback){
	Model.remove(value,(error)=>{
		if(error)callback(error);
		callback(null,"Registro Eliminado")
	})
}
let updateRegistro = function(Model, value, data, callback){
	Model.update(value,data,(error,result)=>{
		if(error)callback(error);
		callback(null,result);
	})
}

module.exports.newRegistro = newRegistro;
module.exports.searchRegistro = searchRegistro;
module.exports.deleteRegistro = deleteRegistro;
module.exports.updateRegistro = updateRegistro;
//USER
module.exports.newUser = function(user,callback){
	newRegistro(User,user,callback);
}
module.exports.searchUser = function(user,callback){
	searchRegistro(User,user,callback);
}
module.exports.deleteUser = function(user,callback){
	deleteRegistro(User,user,callback);
}
module.exports.updateUser = function(user,data,callback){
	updateRegistro(User,user,data,callback);
}
//EVENT
module.exports.newEvent = function(evento, callback){
	newRegistro(Evento,evento, callback);
}
module.exports.searchEvent = function(evento,callback){
	searchRegistro(Evento,evento, callback);
}
module.exports.deleteEvent = function(evento,callback){
	deleteRegistro(Evento,evento,callback);
}
module.exports.updateEvent = function(evento,data,callback){
	updateRegistro(Evento,evento,data,callback);
}
