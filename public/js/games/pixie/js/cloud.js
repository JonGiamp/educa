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