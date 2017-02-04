game.GameoverScreen = me.ScreenObject.extend({
	/**
	 *  action to perform on state change
	 */
	onResetEvent: function() {
		me.game.world.addChild(new me.ColorLayer("background", "#66AACC"), 0);
		sendScore(game.data.score);

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
