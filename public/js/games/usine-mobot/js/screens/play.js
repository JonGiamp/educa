game.PlayScreen = me.ScreenObject.extend({
	/**
	 *  action to perform on state change
	 */
	onResetEvent: function() {
		me.game.world.addChild(new me.ColorLayer("background", "#66CCAA"), 0);
		
		// reset score and lives and init HUD
    game.data.score = 0;
		game.data.lives = 3;
		game.data.words = me.loader.getJSON("words");
		
    this.HUD = new game.HUD.Container();
    me.game.world.addChild(this.HUD);
		
		//rendering entities
		game.data.currentBot = me.game.world.addChild(me.pool.pull("bot"), 20);
		this.panel = me.game.world.addChild(me.pool.pull("panel"), 50);
		
	},

	/**
	 *  action to perform when leaving this screen (state change)
	 */
	onDestroyEvent: function() {
		//remove HUD
    me.game.world.removeChild(this.HUD);
	}
});
