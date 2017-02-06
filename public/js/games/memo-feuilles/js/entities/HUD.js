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
			this.moves = -1;

			this.font = new me.Font("Arial", 32, '#333', "left");
    },

    /**
     * update function
     */
    update : function (time) {
			var update = false;
				// we don't do anything fancy here, so just
        // return true if the score has been updated
        if (this.moves !== game.data.moves) {
					this.moves = game.data.moves;
					update = true;
        }
        return update;
    },

    /**
     * draw the score
     */
    draw : function (renderer) {
			this.font.draw (renderer, "Coups : "+this.moves, 0, 0);
    }

});
