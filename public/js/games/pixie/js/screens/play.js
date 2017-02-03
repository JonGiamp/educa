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
