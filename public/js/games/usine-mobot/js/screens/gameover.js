game.GameoverScreen = me.ScreenObject.extend({
	/**
	 *  action to perform on state change
	 */
	onResetEvent: function() {
		me.game.world.addChild(new me.ColorLayer("background", "#66CCAA"), 0);
		sendScore(game.data.score);

		me.game.world.addChild(new (me.Renderable.extend ({
			// constructor
			init : function () {
				this._super(me.Renderable, 'init', [100, 100, 450, 300]);

				// font for the text
				this.font = new me.Font("Arial", 32, '#DDD', "center");
			},

			update : function (dt) {
				return true;
			},

			draw : function (renderer) {
				renderer.setColor('#444');
        renderer.fillRect(this.pos.x, this.pos.y, this.width, this.height);
				this.font.draw(renderer, "GAMEOVER", me.game.viewport.width/2, me.game.viewport.height/2-96);
				this.font.draw(renderer, "Oh non ! Tu as fait trop\nd'erreurs, les mobots sont\ntous renvoyés à l'usine.\n\nTu as marqué "+game.data.score+" points", me.game.viewport.width/2, me.game.viewport.height/2-16);
			},

			onDestroyEvent : function () {

			}
		})), 2);

		//back to menu button
		function backButtonCallback() {
			me.state.change(me.state.MENU);
		};
		me.game.world.addChild(new smallButton(8+3*me.game.viewport.width/4,me.game.viewport.height-56,me.game.viewport.width/4-16,48,"#A63","#DDD","Retour au menu",backButtonCallback),2);
	},

	/**
	 *  action to perform when leaving this screen (state change)
	 */
	onDestroyEvent: function() {

	}
});

/*************************************************/
/*********** ADDITIONALS CUSTOM OBJECTS **********/
/*************************************************/

var smallButton = me.GUI_Object.extend({

	 init:function (x,y,width,height,bgColor,textColor,buttonText,callback)
	 {
		var settings = {}
		settings.image = "panel";
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
