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
