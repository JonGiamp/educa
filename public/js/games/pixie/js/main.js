var game = {

		data : {
			score : 0,
			chrono : 0
		},

    // Run on page load.
    onload : function (width, height, divId) {
        // Initialize the video.
        if (!me.video.init(width, height, {wrapper : divId/*, scale : 'auto'*/})) {
            alert("Your browser does not support HTML5 canvas.");
            return;
        }

        // add "#debug" to the URL to enable the debug Panel
        if (me.game.HASH.debug === true) {
            window.onReady(function () {
                me.plugin.register.defer(this, me.debug.Panel, "debug", me.input.KEY.V);
            });
        }

        // Initialize the audio.
        me.audio.init("mp3,ogg");

        // Set a callback to run when loading is complete.
        me.loader.onload = this.loaded.bind(this);

        // Load the resources.
        me.loader.preload(game.resources);

				// Initialize melonJS and display a loading screen.
        me.state.change(me.state.LOADING);
        },

    // Run on game resources loaded.
    loaded : function () {
			// set the Title Screen Object
			this.titleScreen = new game.TitleScreen();
			me.state.set(me.state.MENU, this.titleScreen);

			// set the Game Screen Object
			this.playScreen = new game.PlayScreen();
			me.state.set(me.state.PLAY, this.playScreen);

			// set the Lobby Screen Object
			me.state.LOBBY = me.state.USER + 0;
			this.lobbyScreen = new game.LobbyScreen();
			me.state.set(me.state.LOBBY, this.lobbyScreen);

			// set the Multiplayer game Screen Object
			me.state.MULTIPLAYER = me.state.USER + 1;
			this.multiScreen = new game.MultiScreen();
			me.state.set(me.state.MULTIPLAYER, this.multiScreen);

			// set the Gameover Screen Object
			this.gameoverScreen = new game.GameoverScreen();
			me.state.set(me.state.GAMEOVER, this.gameoverScreen);

			me.pool.register("cloud", game.Cloud);
			me.pool.register("cloudMulti", game.CloudMulti);
			me.pool.register("pixie", game.Pixie);
			me.pool.register("pixieMulti", game.PixieMulti);

			// start the game
			me.state.change(me.state.MENU);
    }
};

/**
 * a HUD container and child items
 */

game.HUD = game.HUD || {};


game.HUD.Container = me.Container.extend({

	init: function() {
		// call the constructor
		this._super(me.Container, 'init');

		// persistent across level change
		this.isPersistent = true;

		// make sure we use screen coordinates
		this.floating = true;

		// give a name
		this.name = "HUD";

		//Check if we're in a multiplayer instance
		if(typeof root != 'undefined') {
			this.addChild(new game.HUD.multiHUD(5, 5));
		}
		else {
			this.addChild(new game.HUD.soloHUD(5, 5));
		}
	}
});


/**
 * HUD for a solo game
 */
game.HUD.soloHUD = me.Renderable.extend({
    /**
     * constructor
     */
    init: function(x, y) {

        // call the parent constructor
        // (size does not matter here)
        this._super(me.Renderable, 'init', [x, y, 10, 10]);

        // local copy of the global score
        this.score = -1;

				this.font = new me.Font("Arial", 32, '#DDD', "left");
    },

    /**
     * update function
     */
    update : function (time) {
				//chrono
				game.data.chrono += time/1000;

        // we don't do anything fancy here, so just
        // return true if the score has been updated
        if (this.score !== game.data.score) {
            this.score = game.data.score;
        }
        return true;
    },

    /**
     * draw the score
     */
    draw : function (renderer) {
      	this.font.draw (renderer, "Score : "+game.data.score, 0, 0);
				this.font.draw (renderer, "Temps : "+Math.floor(game.data.chrono), me.game.viewport.width-200, 0);
    }

});

/**
 * HUD for a multiplayer game
 */
game.HUD.multiHUD = me.Renderable.extend({
    /**
     * constructor
     */
    init: function(x, y) {

			// call the parent constructor
			// (size does not matter here)
			this._super(me.Renderable, 'init', [x, y, 10, 10]);

			// local copy of the scores
			this.scores = [];

			for (var i=0; i<4; i++) {
				if(typeof game.data.players[i].username != 'undefined') {
					this.scores.push({
						username: game.data.players[i].username
					})
				}
			}

			this.font = new me.Font("Arial", 32, '#DDD', "left");
    },

    /**
     * update function
     */
    update : function (time) {
			for (var i=0; i<4; i++) {
				if(typeof game.data.players[i].username != 'undefined') {
					this.scores[i].score = game.data.players[i].score;
				}
			}
			return true;
    },

    /**
     * draw the score
     */
    draw : function (renderer) {
			for (var i=0; i<this.scores.length; i++) {
				this.font.draw (renderer, this.scores[i].username+" : "+this.scores[i].score, 0, 40*i)
			}
			this.font.draw (renderer, "Temps : "+Math.floor(game.data.chrono), me.game.viewport.width-200, 0);
    }

});

game.resources = [
	{ name: "pixie", type: "image", src: imgRoot+"/data/img/sleeping_pixie.png" },
	{ name: "cloud", type: "image", src: imgRoot+"/data/img/nuage.png" },
	{ name: "cloud0", type: "image", src: imgRoot+"/data/img/nuage.png" },
	{ name: "cloud1", type: "image", src: imgRoot+"/data/img/nuage2.png" },
	{ name: "cloud2", type: "image", src: imgRoot+"/data/img/nuage3.png" },
	{ name: "cloud3", type: "image", src: imgRoot+"/data/img/nuage.png" }
];

game.Pixie = me.Entity.extend({
	init: function () {
		var image = me.loader.getImage("pixie");
		this._super(me.Entity, "init", [me.game.viewport.width / 2 - image.width / 4, me.game.viewport.height - image.height, {
			image: "pixie",
			width: 186,
			height: 135
		}]);
		this.answer = 0;
		this.font = new me.Font("Arial", 32, '#DDD', "center");

		this.initAnimation();
	},

	initAnimation: function () {
		this.renderable.addAnimation("sleeping", [0,1], 800);
		this.renderable.setCurrentAnimation("sleeping");
	},

	update: function (time) {

			// numeric inputs
			if(this.answer < 1000) {
				if (me.input.isKeyPressed("in1")) {
					this.answer = this.answer*10+1;
				}
				else if (me.input.isKeyPressed("in2")) {
					this.answer = this.answer*10+2;
				}
				else if (me.input.isKeyPressed("in3")) {
					this.answer = this.answer*10+3;
				}
				else if (me.input.isKeyPressed("in4")) {
					this.answer = this.answer*10+4;
				}
				else if (me.input.isKeyPressed("in5")) {
					this.answer = this.answer*10+5;
				}
				else if (me.input.isKeyPressed("in6")) {
					this.answer = this.answer*10+6;
				}
				else if (me.input.isKeyPressed("in7")) {
					this.answer = this.answer*10+7;
				}
				else if (me.input.isKeyPressed("in8")) {
					this.answer = this.answer*10+8;
				}
				else if (me.input.isKeyPressed("in9")) {
					this.answer = this.answer*10+9;
				}
				else if (me.input.isKeyPressed("in0")) {
					this.answer = this.answer*10;
				}
			}

			// enter and backspace handlers
			if (me.input.isKeyPressed("erase")) {
				this.answer = Math.floor(this.answer/10);
			}
			else if (me.input.isKeyPressed("valid")) {
				if(me.game.world.getChildAt(1).solution == this.answer) {
					me.game.world.removeChild(me.game.world.getChildAt(1));
					game.data.score += 100;
				}
				this.answer = 0;
			}

		//default update code
		if (this.renderable) {
				return this.renderable.update(time);
		}
		return me.Renderable.prototype.update.apply(this, [time]);
	},

	draw: function (renderer) {
		var child = this.renderable;
		if (child instanceof me.Renderable) {
				// draw the child renderable's anchorPoint at the entity's
				// anchor point.  the entity's anchor point is a scale from
				// body position to body width/height
				var ax = this.anchorPoint.x * this.body.width,
						ay = this.anchorPoint.y * this.body.height;

				var x = this.pos.x + this.body.pos.x + ax,
						y = this.pos.y + this.body.pos.y + ay;

				renderer.translate(x, y);

				// apply the child transform, if any
				if (child.autoTransform === true && !child.currentTransform.isIdentity()) {
						// calculate the anchor point
						var bounds = child.getBounds();
						var cx = bounds.width * child.anchorPoint.x;
						var cy = bounds.height * child.anchorPoint.y;

						renderer.save();

						// translate to the anchor point
						renderer.translate(cx, cy);
						// apply the object transformation
						renderer.transform(child.currentTransform);
						// translate back
						renderer.translate(-cx, -cy);

						// draw the object
						child.draw(renderer);

						renderer.restore();

				} else {
						child.draw(renderer);
				}
				renderer.translate(-x, -y);
		}
		this.font.draw(renderer, this.answer, this.pos.x+56, this.pos.y+48);
  }
});

game.PixieMulti = me.Entity.extend({
	init: function (username) {
		var image = me.loader.getImage("pixie");
		this._super(me.Entity, "init", [me.game.viewport.width / 2 - image.width / 4, me.game.viewport.height - image.height, {
			image: "pixie",
			width: 186,
			height: 135
		}]);
		this.answer = 0;
		this.username = username;
		this.font = new me.Font("Arial", 32, '#DDD', "center");

		root.on('updatePixie', function(data){
			game.multiScreen.pixie.answer = data;
		});

		this.initAnimation();
	},

	initAnimation: function () {
		this.renderable.addAnimation("sleeping", [0,1], 800);
		this.renderable.setCurrentAnimation("sleeping");
	},

	update: function (time) {

			if (me.input.isKeyPressed("in1")) {
				root.emit('changeAnswer', {user: this.username, value: 1});
			}
			else if (me.input.isKeyPressed("in2")) {
				root.emit('changeAnswer', {user: this.username, value: 2});
			}
			else if (me.input.isKeyPressed("in3")) {
				root.emit('changeAnswer', {user: this.username, value: 3});
			}
			else if (me.input.isKeyPressed("in4")) {
				root.emit('changeAnswer', {user: this.username, value: 4});
			}
			else if (me.input.isKeyPressed("in5")) {
				root.emit('changeAnswer', {user: this.username, value: 5});
			}
			else if (me.input.isKeyPressed("in6")) {
				root.emit('changeAnswer', {user: this.username, value: 6});
			}
			else if (me.input.isKeyPressed("in7")) {
				root.emit('changeAnswer', {user: this.username, value: 7});
			}
			else if (me.input.isKeyPressed("in8")) {
				root.emit('changeAnswer', {user: this.username, value: 8});
			}
			else if (me.input.isKeyPressed("in9")) {
				root.emit('changeAnswer', {user: this.username, value: 9});
			}
			else if (me.input.isKeyPressed("in0")) {
				root.emit('changeAnswer', {user: this.username, value: 0});
			}

			// enter and backspace handlers
			else if (me.input.isKeyPressed("erase")) {
				root.emit('changeAnswer', {user: this.username, value: "erase"});
			}
			else if (me.input.isKeyPressed("valid")) {
				root.emit('changeAnswer', {user: this.username, value: "valid"});
			}

		//default update code
		if (this.renderable) {
				return this.renderable.update(time);
		}
		return me.Renderable.prototype.update.apply(this, [time]);
	},

	draw: function (renderer) {
		var child = this.renderable;
		if (child instanceof me.Renderable) {
				// draw the child renderable's anchorPoint at the entity's
				// anchor point.  the entity's anchor point is a scale from
				// body position to body width/height
				var ax = this.anchorPoint.x * this.body.width,
						ay = this.anchorPoint.y * this.body.height;

				var x = this.pos.x + this.body.pos.x + ax,
						y = this.pos.y + this.body.pos.y + ay;

				renderer.translate(x, y);

				// apply the child transform, if any
				if (child.autoTransform === true && !child.currentTransform.isIdentity()) {
						// calculate the anchor point
						var bounds = child.getBounds();
						var cx = bounds.width * child.anchorPoint.x;
						var cy = bounds.height * child.anchorPoint.y;

						renderer.save();

						// translate to the anchor point
						renderer.translate(cx, cy);
						// apply the object transformation
						renderer.transform(child.currentTransform);
						// translate back
						renderer.translate(-cx, -cy);

						// draw the object
						child.draw(renderer);

						renderer.restore();

				} else {
						child.draw(renderer);
				}
				renderer.translate(-x, -y);
		}
		this.font.draw(renderer, this.answer, this.pos.x+56, this.pos.y+48);
  }
});

game.Cloud = me.Entity.extend({
	init: function () {

		var image = me.loader.getImage("cloud");
		this._super(me.Entity, "init", [me.game.viewport.width/2 - image.width/2, 0, {
			image: image,
			width: image.width,
			height: image.height
		}]);
		this.vy = 0.2;
		this.solution = Math.round(Math.random()*15+5);

		this.a = Math.round(Math.random()*(this.solution-1)+1);
		this.b = this.solution - this.a;
		this.font = new me.Font("Arial", 16, '#000', "center");

	},

	update: function (time) {

			// if the cloud reaches pixie, change to gameover screen
			if(this.pos.y+this.height/2 >= game.playScreen.pixie.pos.y) {
				me.state.change(me.state.GAMEOVER);
			}

			this.pos.y += this.vy;
			return true;
	},

	draw: function (renderer) {
		var child = this.renderable;
		if (child instanceof me.Renderable) {
				// draw the child renderable's anchorPoint at the entity's
				// anchor point.  the entity's anchor point is a scale from
				// body position to body width/height
				var ax = this.anchorPoint.x * this.body.width,
						ay = this.anchorPoint.y * this.body.height;

				var x = this.pos.x + this.body.pos.x + ax,
						y = this.pos.y + this.body.pos.y + ay;

				renderer.translate(x, y);

				// apply the child transform, if any
				if (child.autoTransform === true && !child.currentTransform.isIdentity()) {
						// calculate the anchor point
						var bounds = child.getBounds();
						var cx = bounds.width * child.anchorPoint.x;
						var cy = bounds.height * child.anchorPoint.y;

						renderer.save();

						// translate to the anchor point
						renderer.translate(cx, cy);
						// apply the object transformation
						renderer.transform(child.currentTransform);
						// translate back
						renderer.translate(-cx, -cy);

						// draw the object
						child.draw(renderer);

						renderer.restore();

				} else {
						child.draw(renderer);
				}
				renderer.translate(-x, -y);
		}
		this.font.draw(renderer, this.a+"+"+this.b, this.pos.x+this.width/2, (this.pos.y+this.height/2)-8);
  }
});

game.CloudMulti = me.Entity.extend({
	init: function (x,y,playerIndex,cloudIndex,a,b) {

		this.playerIndex = playerIndex;
		this.cloudIndex = cloudIndex;

		var image = me.loader.getImage("cloud"+playerIndex);
		this._super(me.Entity, "init", [x+((me.game.viewport.width/2)-(image.width*2)), y, {
			image: image,
			width: image.width,
			height: image.height
		}]);

		this.a = a;
		this.b = b;
		this.font = new me.Font("Arial", 16, '#000', "center");
	},

	update: function (time) {
		this.pos.y = game.data.clouds[this.playerIndex][this.cloudIndex].y;
		return true;
	},

	draw: function (renderer) {
		var child = this.renderable;
		if (child instanceof me.Renderable) {
				// draw the child renderable's anchorPoint at the entity's
				// anchor point.  the entity's anchor point is a scale from
				// body position to body width/height
				var ax = this.anchorPoint.x * this.body.width,
						ay = this.anchorPoint.y * this.body.height;

				var x = this.pos.x + this.body.pos.x + ax,
						y = this.pos.y + this.body.pos.y + ay;

				renderer.translate(x, y);

				// apply the child transform, if any
				if (child.autoTransform === true && !child.currentTransform.isIdentity()) {
						// calculate the anchor point
						var bounds = child.getBounds();
						var cx = bounds.width * child.anchorPoint.x;
						var cy = bounds.height * child.anchorPoint.y;

						renderer.save();

						// translate to the anchor point
						renderer.translate(cx, cy);
						// apply the object transformation
						renderer.transform(child.currentTransform);
						// translate back
						renderer.translate(-cx, -cy);

						// draw the object
						child.draw(renderer);

						renderer.restore();

				} else {
						child.draw(renderer);
				}
				renderer.translate(-x, -y);
		}
		this.font.draw(renderer, this.a+"+"+this.b, this.pos.x+this.width/2, (this.pos.y+this.height/2)-8);
  }
});

game.TitleScreen = me.ScreenObject.extend({
  // reset function
  onResetEvent : function () {
		me.game.world.addChild(new me.ColorLayer("background", "#66AACC"), 0);

		//creating the menuLink object
		var menuLink = me.GUI_Object.extend({

			 init:function (x,y,textColor,hoveredColor,linkText,callback)
			 {
				var settings = {}
				settings.image = "cloud";
				settings.framewidth = me.game.viewport.width/2;
				settings.frameheight = 32;
				this._super(me.GUI_Object, "init", [x, y, settings]);
				this.pos.z = 3;
				this.linkText = linkText;
				this.textColor = textColor;
				this.hoveredColor = hoveredColor;
				this.font = new me.Font("Arial", 32, this.textColor, "center");
				this.hoverFont = new me.Font("Arial", 32, this.hoveredColor, "center");
				this.callback = callback;
			 },

			draw : function(renderer) {
				if (this.hover) {
					this.hoverFont.draw(renderer, this.linkText, this.pos.x+this.width/2, this.pos.y);
				}
				else {
					this.font.draw(renderer, this.linkText, this.pos.x+this.width/2, this.pos.y);
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

		//displaying the menu links
		function playButtonCallback() {me.state.change(me.state.PLAY);};
		me.game.world.addChild(new menuLink(me.game.viewport.width/4,me.game.viewport.height/2,"#DDD","#CCAAAA","Jouer",playButtonCallback));

		function multiButtonCallback() {me.state.change(me.state.LOBBY);};
		me.game.world.addChild(new menuLink(me.game.viewport.width/4,me.game.viewport.height/2+64,"#DDD","#CCAAAA","Défier d'autres joueurs",multiButtonCallback));

		//displaying name title
		me.game.world.addChild(new (me.Renderable.extend ({
			// constructor
			init : function () {
				this._super(me.Renderable, 'init', [0, 0, me.game.viewport.width, me.game.viewport.height]);

				// fonts
				this.titleFont = new me.Font("Arial", 48, '#C66', "center");
			},

			draw : function (renderer) {
				this.titleFont.draw(renderer, "Mathttrape-rêves", me.game.viewport.width/2, me.game.viewport.height/2-144);
			},
		})), 2);



  },

  // destroy function
  onDestroyEvent : function () {

  }
});

game.PlayScreen = me.ScreenObject.extend({
	/**
	 *  action to perform on state change
	 */
	onResetEvent: function() {
		me.game.world.addChild(new me.ColorLayer("background", "#66AACC"), 0);

		// reset score and init HUD
		game.data.chrono = 0;
    game.data.score = 0;
    this.HUD = new game.HUD.Container();
    me.game.world.addChild(this.HUD);

		//rendering entities
		this.pixie = me.pool.pull("pixie");
		me.game.world.addChild(this.pixie,10);

		cloudGenerator = setInterval(function() {
			me.game.world.addChild(me.pool.pull("cloud","TheLudo27"), 5);
		}, 5000);

		// pad numbers input
		me.input.bindKey(me.input.KEY.NUMPAD1, "in1", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD2, "in2", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD3, "in3", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD4, "in4", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD5, "in5", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD6, "in6", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD7, "in7", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD8, "in8", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD9, "in9", true, true);
		me.input.bindKey(me.input.KEY.NUMPAD0, "in0", true, true);

		// numbers input
		me.input.bindKey(me.input.KEY.NUM1,    "in1", true, true);
		me.input.bindKey(me.input.KEY.NUM2,    "in2", true, true);
		me.input.bindKey(me.input.KEY.NUM3,    "in3", true, true);
		me.input.bindKey(me.input.KEY.NUM4,    "in4", true, true);
		me.input.bindKey(me.input.KEY.NUM5,    "in5", true, true);
		me.input.bindKey(me.input.KEY.NUM6,    "in6", true, true);
		me.input.bindKey(me.input.KEY.NUM7,    "in7", true, true);
		me.input.bindKey(me.input.KEY.NUM8,    "in8", true, true);
		me.input.bindKey(me.input.KEY.NUM9,    "in9", true, true);
		me.input.bindKey(me.input.KEY.NUM0,    "in0", true, true);

		// enter and return keys
		me.input.bindKey(me.input.KEY.ENTER,    "valid", true, true);
		me.input.bindKey(me.input.KEY.BACKSPACE,"erase", true, true);
	},

	/**
	 *  action to perform when leaving this screen (state change)
	 */
	onDestroyEvent: function() {
		//clearing cloud generation
		clearInterval(cloudGenerator);
		//remove HUD
    me.game.world.removeChild(this.HUD);
		//unbind les actions, kill HUD, kill the chrono
	}
});

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
		// root = io.connect('localhost:2479/');
		// root = io('localhost:2479');
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

game.MultiScreen = me.ScreenObject.extend({
	/**
	 *  action to perform on state change
	 */
	onResetEvent: function() {
		var connectedUser = "TheLudo27";

		me.game.world.addChild(new me.ColorLayer("background", "#66AACC"), 0);

		game.data.chrono = 0;
		game.data.players = [];
		game.data.clouds = [[],[],[],[]];

		root.emit('askInitMultiplayer', connectedUser);

		root.on('sendInitMultiplayer', function(data){

			game.data.players = data;

			// reset score and init HUD
			game.multiScreen.HUD = new game.HUD.Container();
			me.game.world.addChild(game.multiScreen.HUD,999);

			//rendering entities
			game.multiScreen.pixie = me.pool.pull("pixieMulti",connectedUser);
			me.game.world.addChild(game.multiScreen.pixie,10);

			// pad numbers input
			me.input.bindKey(me.input.KEY.NUMPAD1, "in1", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD2, "in2", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD3, "in3", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD4, "in4", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD5, "in5", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD6, "in6", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD7, "in7", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD8, "in8", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD9, "in9", true, true);
			me.input.bindKey(me.input.KEY.NUMPAD0, "in0", true, true);

			// numbers input
			me.input.bindKey(me.input.KEY.NUM1,    "in1", true, true);
			me.input.bindKey(me.input.KEY.NUM2,    "in2", true, true);
			me.input.bindKey(me.input.KEY.NUM3,    "in3", true, true);
			me.input.bindKey(me.input.KEY.NUM4,    "in4", true, true);
			me.input.bindKey(me.input.KEY.NUM5,    "in5", true, true);
			me.input.bindKey(me.input.KEY.NUM6,    "in6", true, true);
			me.input.bindKey(me.input.KEY.NUM7,    "in7", true, true);
			me.input.bindKey(me.input.KEY.NUM8,    "in8", true, true);
			me.input.bindKey(me.input.KEY.NUM9,    "in9", true, true);
			me.input.bindKey(me.input.KEY.NUM0,    "in0", true, true);

			// enter and return keys
			me.input.bindKey(me.input.KEY.ENTER,    "valid", true, true);
			me.input.bindKey(me.input.KEY.BACKSPACE,"erase", true, true);

		});

		root.on('updateMultiplayer', function(data){
			data.gameover.forEach(function(player) {
				if(player.username === connectedUser) {
					for (var i=0; i<4; i++) {
						if(game.data.players[i].username === connectedUser) {
							game.data.score = game.data.players[i].score;
						}
					}
					me.state.change(me.state.GAMEOVER);
				}
			});

			game.data.chrono = data.chrono;
			game.data.players = data.players;

			//checking if the cloud total didnt change
			//if it did, update the renderables associated to the clouds
			for(var i=0; i<4; i++) {
				if(game.data.clouds[i].length != data.clouds[i].length) {
					for (var j=0; j<game.data.clouds[i].length; j++) {
						me.game.world.removeChild(game.data.clouds[i][j].renderable);
					}
					game.data.clouds[i] = data.clouds[i];
					for (var j=0; j<game.data.clouds[i].length; j++) {
						game.data.clouds[i][j].renderable = me.pool.pull("cloudMulti",game.data.clouds[i][j].x,game.data.clouds[i][j].y,i,j,game.data.clouds[i][j].a,game.data.clouds[i][j].b);
						me.game.world.addChild(game.data.clouds[i][j].renderable, 5);
					}
				}
				else {
					for (var j=0; j<game.data.clouds[i].length; j++) {
						game.data.clouds[i][j].y = data.clouds[i][j].y;
					}
				}
			}
		});
	},

	/**
	 *  action to perform when leaving this screen (state change)
	 */
	onDestroyEvent: function() {
		//remove HUD
    me.game.world.removeChild(game.multiScreen.HUD);
		root.removeEventListener('updateMultiplayer');;
		delete root;
		//unbind les actions
	}
});

game.GameoverScreen = me.ScreenObject.extend({
	/**
	 *  action to perform on state change
	 */
	onResetEvent: function() {
		me.game.world.addChild(new me.ColorLayer("background", "#66AACC"), 0);

		me.game.world.addChild(new (me.Renderable.extend ({
			// constructor
			init : function () {
				this._super(me.Renderable, 'init', [me.game.viewport.width/4, me.game.viewport.height/4, me.game.viewport.width/2, me.game.viewport.height/2]);

				this.background = new me.ColorLayer("scoreBox", "#444444");

				// font for the text
				this.font = new me.Font("Arial", 32, '#DDD', "center");
			},

			update : function (dt) {
				return true;
			},

			draw : function (renderer) {
				renderer.setColor('#888');
        renderer.fillRect(me.game.viewport.width/8, me.game.viewport.height/8, 3*me.game.viewport.width/4, 3*me.game.viewport.height/4);
				this.font.draw(renderer, "GAMEOVER", me.game.viewport.width/2, me.game.viewport.height/2-64);
				this.font.draw(renderer, "Pixie a dormi "+Math.floor(game.data.chrono)+" secondes et\ntu as marqué "+game.data.score+" points", me.game.viewport.width/2, me.game.viewport.height/2-16);
				// sendScore(game.data.score);
			},

			onDestroyEvent : function () {

			}
		})), 1);

		//back to menu button
		function backButtonCallback() {
			me.state.change(me.state.MENU);
		};
		me.game.world.addChild(new smallButton(8+3*me.game.viewport.width/4,me.game.viewport.height-56,me.game.viewport.width/4-16,48,"#CCAAAA","#DDD","Retour au menu",backButtonCallback),2);
	},

	/**
	 *  action to perform when leaving this screen (state change)
	 */
	onDestroyEvent: function() {

	}
});
