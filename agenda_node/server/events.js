const Router = require('express').Router();
const Operaciones = require('./CRUD.js');

Router.get('/all',(req,res)=>{
	evento = {}
		Operaciones.searchEvent(evento,(error,result)=>{
			res.json(result)
		})
})

Router.post('/delete/:id',(req,res)=>{
	evento = {id: req.body.id}
	Operaciones.deleteEvent(evento,(error,result)=>{
		console.log(result);
		res.send("OK");
	})
})

Router.post('/new',(req,res)=>{
	var allDay= (req.body.end=='')? true: false;
	var evento = {
		id: Math.random()*10000,
		title : req.body.title,
		start: req.body.start,
		end: req.body.end,
		allDay: allDay
	}
	Operaciones.newEvent(evento,(error, result)=>{
		if(error){
			console.log(error);
			res.send("error");
		}
		console.log(result);
		res.send("OK")
	})
})

Router.post('/update/:id',(req,res)=>{
	var evento = {id: req.body.id}
	var data = {start: req.body.start, end: req.body.end}
	Operaciones.updateEvent(evento, data, (error, result)=>{
		if(error){
			console.log(error);
			res.json({msg:"error"});
			return;
		}
		console.log(result);
		res.json({msg:"OK"});
	})
})
module.exports = Router
