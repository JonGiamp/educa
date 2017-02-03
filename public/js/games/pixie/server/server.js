/******************************************************************/
/************************ INITIALISATION **************************/
/******************************************************************/

	/***************** INITIALISATION NODE SERVER ********************/

	/* Packages import */
	var http = require('http');
	var url = require('url');
	var fs = require('fs');
	var io = require('socket.io');

	/* creating the http server */
	var server = http.createServer();
	server.listen(2479);
	console.log("Server's up ! :)");

	/************* INITIALISATION SOCKET.IO AND ARRAYS *************/

	var root = new io(server);

	var players = [];
	var rooms = [];

	/* Classes import */
	var classes = require('./classes');

	console.log("Rooms ready");

/******************************************************************/
/********************* SOCKET EVENT HANDLERS **********************/
/******************************************************************/

root.on('connection', function(client){
	
	/***************** LOBBY **************************/
	
	//registering client ID
	players.push({"clientId" : client.id});
	client.emit('waitingUsername',{id: client.id, user: ""});
	
	//step 2 of connection
	client.on('connection2', function(data){
		//associating username with client ID
		for (player in players) {
			if(players[player].clientId === data.id) {
				players[player].user = data.username;
				players[player].inRoomOf = data.username;
			}
		}
		//console notification
		console.log("Player "+data.username+" connected to Mathrrape-rêves multiplayer");
		
		//creating the room
		rooms.push(new classes.Room(data.username,data.id));

		//listing the rooms and transmitting the data
		emitRoomList(client,rooms);
	});
	
	//room change handler
	client.on('joinRoom', function(data){
		
		for(room in rooms) {
			
			//removing player from his current room and checking if it isnt empty afterward
			var isEmpty = true;
			for (var i=0; i<4; i++) {
				if (rooms[room].players[i].username == data.user) {
					rooms[room].players[i] = {};
				}
				else if (rooms[room].players[i].username != undefined) {
					isEmpty = false;
				}
			}
			
			//deleting room if empty
			if(isEmpty) {
				delete rooms[room];
			}
			
			//putting it to his new room
			else if (rooms[room].owner == data.roomOwner) {
				
				var userClientId = "";
				for (player in players) {
					if(players[player].user === data.user) {
						userClientId = players[player].clientId;
						break;
					}
				}
				
				for (var i=0; i<4; i++) {
					if (rooms[room].players[i].username == undefined) {
						rooms[room].players[i] = new classes.Player(data.user,userClientId);
						
						//updating data in the players array
						for (player in players) {
							if(players[player].user === data.user) {
								players[player].inRoomOf = data.roomOwner;
							}
						}
						
						//console notification
						console.log(data.user+" joined "+data.roomOwner+"'s room");
						break;
					}
				}
				
				emitRoomUpdate(client,rooms[room])
			}
			
		}
	});
	
	//ready button handler
	client.on('switchReady', function(data){
		
		for(room in rooms) {
			
			if(rooms[room].owner === data.roomOwner) {
				
				//to know if everybody is ready and if we can start the game
				//default value is true, become false if we find a player not ready
				var everybodyReady = true;
				
				for (var i=0; i<4; i++) {
					if (rooms[room].players[i].username === data.user) {
						//toggle the ready attribute
						rooms[room].players[i].ready = !rooms[room].players[i].ready;
						emitRoomUpdate(client,rooms[room]);
					}
					if ((rooms[room].players[i].username != undefined) && (!rooms[room].players[i].ready)) {
						everybodyReady = false;
					}
				}
				
				//initialize and start the game if everybody is ready
				if (everybodyReady) {
					rooms[room].chrono = 0;
					rooms[room].nextCloudTo = 0;
					rooms[room].totalPlayer = 0;
					rooms[room].gameover = [];
					for (var i=0; i<4; i++) {
						if(rooms[room].players[i].username != undefined) {
							rooms[room].totalPlayer++;
						}
					}
					
					//set up the periodic cloud generation
					rooms[room].cloudGenerator = setInterval(function() {
						var cloudWidth = 141;
						if(rooms[room].gameover.length != rooms[room].totalPlayer) {
							rooms[room].gameover.forEach(function(playerOver){
								if (playerOver.index == rooms[room].nextCloudTo) {
									rooms[room].nextCloudTo++;
									if (rooms[room].nextCloudTo >= rooms[room].totalPlayer ) {
										rooms[room].nextCloudTo = 0;
									}
								}
							})
							rooms[room].clouds[rooms[room].nextCloudTo].push(new classes.Cloud(
								rooms[room].nextCloudTo*cloudWidth+(4-rooms[room].totalPlayer)*(cloudWidth/2),
								rooms[room].players[rooms[room].nextCloudTo].difficulty
							));
							rooms[room].nextCloudTo++;
							if (rooms[room].nextCloudTo >= rooms[room].totalPlayer ) {
								rooms[room].nextCloudTo = 0;
							}
						}
						else {
							deleteRoom(room);
						}
					}, 5000/rooms[room].totalPlayer);
					
					//set up the periodic updates sent to clients
					rooms[room].updateChrono = setInterval(function() {
						rooms[room].chrono += 16.66;
						for (var i=0; i<rooms[room].totalPlayer; i++) {
							for (cloud in rooms[room].clouds[i]) {
								rooms[room].clouds[i][cloud].y += rooms[room].clouds[i][cloud].vy;
								if(rooms[room].clouds[i][cloud].y >= 450-135-48) {
									rooms[room].clouds[i] = [];
									rooms[room].gameover.push({username:rooms[room].players[i].username, index:i});
									console.log(rooms[room].players[i].username+" has lost");
									break;
								}
							}
						}
						var response = {
							chrono: Math.floor(rooms[room].chrono/1000),
							players: rooms[room].players,
							clouds: rooms[room].clouds,
							gameover: rooms[room].gameover
						};
						emitToAllRoom(client,rooms[room],'updateMultiplayer',response)
					}, 16.66);
					
					emitToAllRoom(client,rooms[room],'startGame');
				}
			}
			
		}
		
	});
	
	/***************** MULTIPLAYER **************************/
	
	client.on('askInitMultiplayer', function(data){
		
		var response = [];
		var inRoomOf = "";
		for (player in players) {
			if(players[player].user === data) {
				inRoomOf = players[player].inRoomOf;
				break;
			}
		}
		for (room in rooms) {
			if(rooms[room].owner === inRoomOf) {
				response = rooms[room].players;
			}
		}
		client.emit('sendInitMultiplayer',response);
		
	});
	
	client.on('changeAnswer', function(data){
		
		var response = {};
		var inRoomOf = "";
		for (player in players) {
			if(players[player].user === data.user) {
				inRoomOf = players[player].inRoomOf;
				break;
			}
		}
		for (room in rooms) {
			if(rooms[room].owner === inRoomOf) {
				for (var i=0; i<4; i++) {
					if(rooms[room].players[i].username === data.user) {
						switch(data.value) {
							case 1:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+1;
								break;
							case 2:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+2;
								break;
							case 3:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+3;
								break;
							case 4:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+4;
								break;
							case 5:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+5;
								break;
							case 6:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+6;
								break;
							case 7:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+7;
								break;
							case 8:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+8;
								break;
							case 9:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10+9;
								break;
							case 0:
								rooms[room].players[i].answer = rooms[room].players[i].answer*10;
								break;
							case "erase":
								rooms[room].players[i].answer = Math.floor(rooms[room].players[i].answer/10);
								break;
							case "valid":
								if((rooms[room].clouds[i][0]) && (rooms[room].players[i].answer === rooms[room].clouds[i][0].solution)) {
									rooms[room].clouds[i].shift();
									rooms[room].players[i].score += 100;
								}
								rooms[room].players[i].answer = 0;
								break;
						}
						client.emit('updatePixie',rooms[room].players[i].answer);
						break;
					}
				}
			}
		}
		
	});
	
	/***************** DISCONNECTION HANDLER **************************/
	
	client.on('disconnect', function(data){
		
		for (player in players) {
			if(players[player].clientId === client.id) {
				//Deconnection from non-playing room
				for (room in rooms) {
					var isEmpty = true;

					for (var i=0; i<4; i++) {
						if(rooms[room].players[i].username === players[player].user){
							rooms[room].players[i] = {};
							emitToAllRoom(client,rooms[room],'updateRoom',room);
						}
						else if (rooms[room].players[i].username != undefined) {
							isEmpty = false;
						}
					}

					//stopping chrono + cloudGenerator and deleting room if empty
					if(isEmpty) {
						deleteRoom(room);
					}
				}

				console.log("Player "+players[player].user+" disconnected from Mathrrape-rêves multiplayer");
				delete players[player];
			}
		}
	});
	
});


/*********************** FUNCTIONS ****************************/

function emitToAllRoom(client,room,event,data) {
	client.emit(event,data);
	for (var i=0; i<4; i++) {
		if(room.players[i].clientId != undefined) {
			client.broadcast.to(room.players[i].clientId).emit(event,data);
		}
	}
}

function emitRoomList(client,rooms) {
	//listing the rooms and transmitting the data
	var response = [];
	for (room in rooms) {
		response.push(rooms[room]);
	}
	client.emit('roomlist',response);
}

function emitRoomUpdate(client,room) {
	emitToAllRoom(client,room,'updateRoom',room);
}

function deleteRoom(i) {
	if (rooms[i].chrono) {
		clearInterval(rooms[i].updateChrono);
		clearInterval(rooms[i].cloudGenerator);
	}
	delete rooms[i];
}
