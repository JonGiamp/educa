game.CloudMulti = me.Entity.extend({
	init: function (x,y,playerIndex,cloudIndex,a,b) {

		this.playerIndex = playerIndex;
		this.cloudIndex = cloudIndex;
		
		var image = me.loader.getImage("cloud"+playerIndex);
		this._super(me.Entity, "init", [x+((me.game.viewport.width/2)-(image.width*2)), y, {
			image: image,
			width: image.width,
			height: image.height
		}]);

		this.a = a;
		this.b = b;
		this.font = new me.Font("Arial", 16, '#000', "center");
	},

	update: function (time) {
		this.pos.y = game.data.clouds[this.playerIndex][this.cloudIndex].y;
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