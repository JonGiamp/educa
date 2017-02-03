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