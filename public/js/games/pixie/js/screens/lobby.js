game.LobbyScreen = me.ScreenObject.extend({
  // reset function
  onResetEvent : function () {
		var connectedUser = "TheLudo27";
		var firstRender = true;
		var roomPanel = {};
		var roomList = [];
		
		me.game.world.addChild(new me.ColorLayer("background", "#CCAAAA"), 0);

		//back to menu button
		function backButtonCallback() {
			me.state.change(me.state.MENU);
			root.disconnect();
			delete root;
		};
		me.game.world.addChild(new smallButton(8,me.game.viewport.height-56,me.game.viewport.width/4-16,48,"#CCAAAA","#DDD","Retour au menu",backButtonCallback),1);

		//Server root socket initialisation
		root = io('http://localhost:2479');

		//Sending additionnals data to server in order to associate the client id to the connected user
		root.on('waitingUsername', function(data){
			root.emit('connection2',{id: data.id, username: connectedUser});
		});
		
		root.on('roomlist', function(data){
			
			//to know if the correct room was found
			var isFound = false;
			
			//checking if it is the first rendering of the lobby
			//we need this because the first render uses me.game.world.addChild
			//while the update only updates child attributes
			if(firstRender){
				for(var i=0; i<data.length; i++){
					
					//if we didn't find the room the player is in, check is if that one is
					if(!isFound){
						var currentroom = false;

						for(var j=0; j<4; j++){

							//displaying the current room the player is in
							if(data[i].players[j].username == connectedUser){
								roomPanel = me.game.world.addChild(new (me.Renderable.extend({
									init : function() {
										// position, width, height
										this.i = i;
										this._super(me.Renderable, "init", [8, 60, me.game.viewport.width/2-16, 1]);
										this.z = 100;
										this.titleFont = new me.Font("Arial", 24, '#DDD', "center");
										this.font = new me.Font("Arial", 16, '#DDD', "left");
										this.colors = ["#3E9FFF","#1FB55F","#FF4057","#91257D"];
										this.owner = data[this.i].owner;
										this.players = [{},{},{},{}];
										
										//re-looping through the players to list the players into the local RoomPanel Object
										for(var k=0; k<4; k++){
											if (data[this.i].players[k].username != undefined){
												this.players[k] = {
													username: data[this.i].players[k].username,
													ready: data[this.i].players[k].ready
												}
											}
										}
										
										this.readyButton = me.game.world.addChild(new (smallButton.extend({
											init : function() {
												this.i = i;
												this._super(smallButton, "init", [me.game.viewport.width/4+8,me.game.viewport.height-56,me.game.viewport.width/4-16,48,"#CCAAAA","#DDD","Prêt",function () {
													root.emit("switchReady",{roomOwner: data[this.i].owner, user: connectedUser});
												}]);
											},
										})),3);
									},

									draw : function(renderer) {
										renderer.setColor('#DDD');
										renderer.strokeRect(this.pos.x, this.pos.y, this.width, this.height);
										this.titleFont.draw(renderer, "Partie de "+this.owner, me.game.viewport.width/4, 20);

										for(var j=0; j<4; j++){
											if (this.players[j].username != undefined){
												
												//displaying the player's color
												renderer.setColor(this.colors[j]);
												renderer.fillRect(this.pos.x+16, this.pos.y+16+80*j, 32, 32);
												
												if(this.players[j].ready) {
													renderer.setColor("#6F6");
												}
												else {
													renderer.setColor("#F66");
												}
												renderer.fillArc(this.width-32,this.pos.y+16+80*j,16,0,2*Math.PI);
												
												//displaying player's name
												this.font.draw(renderer, this.players[j].username, this.pos.x+56, this.pos.y+24+80*j);
											}
										}
									},

									update : function() {
										return true;
									}
								})),2);

								currentroom = true;
								isFound = true;
							}

						}
					}

					//displaying the other players' lobbies
					if (!currentroom) {
						//the position in the room list
						var listPos = i;
						if(isFound) {
							listPos--;
						}
						roomList[listPos] = me.game.world.addChild(new (smallButton.extend({
							init : function() {
								this.i = i;
								this._super(smallButton, "init", [me.game.viewport.width/2+8,8+56*listPos,me.game.viewport.width/2-16,48,"#CCAAAA","#DDD","Partie de"+data[i].owner,function (i) {
									root.emit('joinRoom',{user: connectedUser, roomOwner: data[this.i].owner});
								}]);
							},
						})),listPos+4);
					}
				}
			}
			
			//updating the child attributes/informations displayed
			else{
				
				//removing all join button childs
				/*for(var i=0; i<roomList.length; i++){
					me.game.world.removeChild(me.game.world.getChildAt(i+4));
					me.game.world.removeChild(roomList[i]);
					console.log(me.game.world.getChildAt(i+5));
				}*/
				
				//reset the server list
				roomList = [];
				
				for(var i=0; i<data.length; i++){
					var currentroom = false;

					for(var j=0; j<4; j++){

						//displaying the room the player is currently in
						if(data[i].players[j].username == connectedUser){
							
							roomPanel.owner = data[i].owner;
							roomPanel.players = [{},{},{},{}];
							roomPanel.readyButton.i = i;
							
							for(var k=0; k<4; k++){
								if (data[i].players[k].username != undefined){
									roomPanel.players[k].username = data[i].players[k].username;
								}
							}
							
							currentroom = true;
							isFound = true;
						}
						
						//displaying the other players' lobbies
						if (!currentroom) {
							//the position in the room list
							var listPos = i;
							if(isFound) {
								listPos--;
							}
							roomList[listPos] = me.game.world.addChild(new (smallButton.extend({
								init : function() {
									this.i = i;
									this._super(smallButton, "init", [me.game.viewport.width/2+8,8+56*listPos,me.game.viewport.width/2-16,48,"#CCAAAA","#DDD","Partie de"+data[i].owner,function (i) {
										root.emit('joinRoom',{user: connectedUser, roomOwner: data[this.i].owner});
									}]);
								},
							})),listPos+4);
						}
					}
				}

				
			}
			
			if(firstRender) {
				firstRender = false;
			}
		});
		
		root.on('updateRoom', function(data){
			roomPanel.owner = data.owner;
			for(let i=0; i<4; i++){
				if (data.players[i].username != undefined){
					roomPanel.players[i].username = data.players[i].username;
					roomPanel.players[i].ready = data.players[i].ready;
					me.game.world.removeChild(roomPanel.readyButton);
					roomPanel.readyButton = me.game.world.addChild(new (smallButton.extend({
						init : function() {
							this.i = i;
							this._super(smallButton, "init", [me.game.viewport.width/4+8,me.game.viewport.height-56,me.game.viewport.width/4-16,48,"#CCAAAA","#DDD","Prêt",function () {
								root.emit("switchReady",{roomOwner: roomPanel.owner, user: connectedUser});
							}]);
						},
					})),3);
				}
			}
		});
		
		root.on('startGame', function(data){
			
			me.state.change(me.state.MULTIPLAYER);
			
		});
		
  },

  // destroy function
  onDestroyEvent : function () {
    
  }
});

/*************************************************/
/*********** ADDITIONALS CUSTOM OBJECTS **********/
/*************************************************/

var smallButton = me.GUI_Object.extend({

	 init:function (x,y,width,height,bgColor,textColor,buttonText,callback)
	 {
		var settings = {}
		settings.image = "cloud";
		settings.framewidth = width;
		settings.frameheight = height;
		this._super(me.GUI_Object, "init", [x, y, settings]);
		this.pos.z = 3;
		this.buttonText = buttonText;
		this.bgColor = bgColor;
		this.textColor = textColor;
		this.font = new me.Font("Arial", 16, this.textColor, "center");
		this.hoverFont = new me.Font("Arial", 16, this.bgColor, "center");
		this.callback = callback;
	 },

	draw : function(renderer) {
		renderer.setColor(this.textColor);
		renderer.strokeRect(this.pos.x, this.pos.y, this.width, this.height);
		if (this.hover) {
			renderer.fillRect(this.pos.x, this.pos.y, this.width, this.height);
			this.hoverFont.draw(renderer, this.buttonText, this.pos.x+this.width/2, this.pos.y+this.height/2-8);
		}
		else {
			this.font.draw(renderer, this.buttonText, this.pos.x+this.width/2, this.pos.y+this.height/2-8);
		}
	},

	update : function(dt) {
		return true;
	},

	onClick:function (event)
	{
		this.callback();
		// don't propagate the event
		return false;
	}
});