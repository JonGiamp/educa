game.Bot = me.Entity.extend({
	init: function () {
		var image = me.loader.getImage("mobot_idle");
		this._super(me.Entity, "init", [me.game.viewport.width/2 - 216/2, me.game.viewport.height/4 - 252/3, {
			image: image,
			width: 216,
			height: 252
		}]);
		this.font = new me.Font("Arial", 32, '#8F0', "center");
		this.solution = this.initWord();
		
		this.initAnimation();
		
		this.floatChrono = 0;
	},
	
	initWord: function() {
		var wordIndex = Math.floor(Math.random()*game.data.words.length);
		var variation = "correct";
		if(Math.random() > 0.5) {
			variation = "uncorrect";
		}
		var variationIndex = Math.floor(Math.random()*game.data.words[wordIndex][variation].length);
		return game.data.words[wordIndex][variation][variationIndex];
	},
	
	initAnimation: function () {
		this.renderable.addAnimation("idle", [0,1,2], 120);
		this.renderable.setCurrentAnimation("idle");
	},

	update: function (time) {
		//floating effect
		this.floatChrono += time;
		
		if(Math.cos(this.floatChrono/1500*2*Math.PI) > 0.9) {
			this.pos.y += 0.5;
		}
		else if(Math.cos(this.floatChrono/1500*2*Math.PI) < -0.9) {
			this.pos.y -= 0.5;
		}
		
		//default update code
		if (this.renderable) {
				return this.renderable.update(time);
		}
		return me.Renderable.prototype.update.apply(this, [time]);
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
		this.font.draw(renderer, this.solution, this.pos.x+this.width/2, this.pos.y+this.height-65);
  }
});