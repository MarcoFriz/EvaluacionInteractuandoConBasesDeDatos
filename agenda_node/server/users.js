const Router = require('express').Router();
const Operaciones = require('./CRUD.js');

Router.post('/login',(req,res)=>{
	user = {userName: req.body.user, userPass: req.body.pass};
	console.log(user);
	Operaciones.searchUser(user,(error, result)=>{
			 if(error){
				 console.log(error);
				 res.send("Error");
			 }
			 if(result[0]==null){
				 console.log(result);
				 res.send("Error")
			 }else{
				 console.log("Usuario Registrado");
			 	 res.send("Validado")
		 	 }
		 })
})
//Se que esto no es seguro pero no quice crear
//un una nueva pagina
Router.get('/new/:name/:pass',(req,res)=>{
	user = {
		userId : Math.random()*10000,
		userName : req.params.name,
		userPass : req.params.pass
	};
	Operaciones.newUser(user,(error,result)=>{
		if(error)console.log(error);
		console.log(result);
		res.send("OK")
	})
})

Router.get('/delete/:id',(req,res)=>{
	user = {userId: req.params.id};
	Operaciones.deleteUser(user,(error,result)=>{
		if(error)console.log(error);
		console.log(result);
		res.send("OK")
	})
})



module.exports = Router
