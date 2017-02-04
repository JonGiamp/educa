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

        // add our child score object at the top left corner
        this.addChild(new game.HUD.ScoreItem(5, 5));
    }
});


/**
 * a basic HUD item to display score
 */
game.HUD.ScoreItem = me.Renderable.extend({
    /**
     * constructor
     */
    init: function(x, y) {
			// call the parent constructor
			// (size does not matter here)
			this._super(me.Renderable, 'init', [x, y, 10, 10]);

			// local copy of the game datas
			this.score = -1;
			this.lives = -1;

			this.font = new me.Font("Arial", 32, '#DDD', "left");
    },

    /**
     * update function
     */
    update : function (time) {
			var update = false;
				// we don't do anything fancy here, so just
        // return true if the score has been updated
        if (this.score !== game.data.score) {
					this.score = game.data.score;
					update = true;
        }
				if (this.lives !== game.data.lives) {
					this.lives = game.data.lives;
					update = true;
        }
        return update;
    },

    /**
     * draw the score
     */
    draw : function (renderer) {
			this.font.draw (renderer, "Score : "+this.score, 0, 0);
			this.font.draw (renderer, "Vies : "+this.lives, me.game.viewport.width-120, 0);
    }

});
