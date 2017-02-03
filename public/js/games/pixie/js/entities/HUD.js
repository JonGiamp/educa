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
